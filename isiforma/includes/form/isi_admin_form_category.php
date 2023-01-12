<?php

require_once plugin_dir_path(__FILE__) . '../isi_constants.php';


//category for training: Bureautique...
/*
 * view_form_category : function for create a table for category list.
 * In the table, it'possible to delete or modify a category
 * a category can itself become a parent category of another category
 * the parent category can
 * use a foreach for complete the table with elements
 */

function view_form_category()
{
    //category for training: Bureautique...
    ?>
    <button type="button" class="collapsible">Category</button>
    <div class="content-isi-form">
        <?php

        /**
         * Function list_category for list all category on table for view form.
         */
        list_category();
        ?>
        <!-- title for new category -->
        <h3>New Category</h3>

        <!-- Form post for admin-post Category -->
        <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="isi_form_response_category">
            <table>
                <tr>
                    <!-- One input for category Name -->
                    <td><label for="category_name">Name :</label></td>
                    <td><input name="category_name" type="text" id="category_name" required></td>
                </tr>
                <tr>
                    <td>
                        <?php

                        /**
                         * Select for select parent category function.
                         * display on select / Option
                         */

                        select_parent_category();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <!-- Button Submit for insert category-->
                        <button type="submit" name="submit_category" class="btn button-primary">Validate</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}


/**
 * admin-post for insert category
 * need add_action for admin_post_{action}
 */
add_action('admin_post_isi_form_response_category', 'insert_category');

/**
 * @return voi
 * Function insert category
 * insert a new category
 * one input with name.
 * insert on table prefixwp + isiforma_category
 * insert on table prefixwp + terms
 * insert on table prefixwp + term_taxonomy
 *
 */

function insert_category()
{
    /*
     * Submit post if submit category is good
     */
    if (isset($_POST['submit_category'])) {

        global $wpdb;
        /**
         * Table name for wp_terms
         */
        $table_name_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
        /**
         * Table name for wp_term_taxonomy
         */
        $table_name_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;
        /**
         * Table name for isiforma_category
         */
        $table_name_category = $wpdb->prefix . TABLE_NAME_ISI_CATEGORY;

        //input name -> name category
        $category_name = $_POST['category_name'];
        //input category parent.
        //take a category parent id for insert on table category where id
        $category_parent_category = $_POST['category_parent_category'];

        //SQL SELECT FOR SELECT PARENT id on term_id for update on term_taxonomy.

        $sqlSelectParent = "SELECT `term_id` 
                            FROM $table_name_wp_term 
                            INNER JOIN $table_name_category 
                            ON $table_name_wp_term.name = $table_name_category.name
                            WHERE $table_name_category.id = $category_parent_category";

        $idParent = $wpdb->get_row($sqlSelectParent);

        // if is not emptY name on form. -> insert

        if (!empty($category_name)) {

            /**
             * Insert on table isiforma_category
             * id auto_increment
             * name
             * category parent id for parent.
             *
             */
            $wpdb->insert(
                $table_name_category,
                array(
                    'name' => $category_name,
                    'category_parent_id' => $category_parent_category,
                )
            );

            /**
             * Insert on table wp_term.
             * auto increment id
             * name and slug
             *
             */

            $wpdb->insert($table_name_wp_term,
                array(
                    'name' => $category_name,
                    'slug' => strtolower($category_name),
                    'term_group' => 0,
                ));

            //take a last id insert on table and insert on wp_term_taxonomy.

            $lastId = $wpdb->insert_id;
            $wpdb->insert($table_name_wp_term_taxonomy, array(
                'term_taxonomy_id' => $lastId,
                'term_id' => $lastId,
                'taxonomy' => 'categorytraining',
                'description' => '',
                'parent' => (int)$idParent->term_id,
                'count' => 0,
            ));

            // Rediect admin settings.
            wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
        }
    }
}


/**
 * Function for parent category.
 * Select category for foreach for display select option html
 */
function select_parent_category()
{

    //global wpdb
    global $wpdb;

    //table name for isiforma_category
    $table = $wpdb->prefix . TABLE_NAME_ISI_CATEGORY;
    //requete select, select all category
    $requete = "SELECT * FROM $table";
    //get results, create a array of category
    $results_categorys = $wpdb->get_results($requete);

    ?>

        <!-- display for parent category html/ Select / Option . -->
    <label for="select-parent-category">Parent Category : </label>
    <select name="category_parent_category" id="select-parent-category">
        <?php
        foreach ($results_categorys as $category) {
            echo "<option value=" . $category->id . "> $category->name</option>";
        }

        ?>
    </select>
    <?php

    // return
    return $results_categorys;
}


/*
 * Function for select all elements of table and place them in a table in settings page
 */
function list_category()
{
    $iconeDelete = URL_ICONE_DELETE;
    $iconeModify = URL_ICONE_MODIFY;

    global $wpdb;
    $table = $wpdb->prefix . TABLE_NAME_ISI_CATEGORY;
    $requete = "SELECT * FROM $table";
    $results_categorys = $wpdb->get_results($requete);

    if ($results_categorys != null) {
        ?>
        <h3>List category</h3>
        <div>
            <table>
                <tr>
                    <th>Category</th>
                    <th>Parent</th>
                    <th>Actions</th>
                </tr>
                <?php

                $i = 0;
                //Foreach du select de toutes les catégories. contenu dans le array $results_categorys
                foreach ($results_categorys as $result) {
                    $i++;


                    /*
                     * ---------------------add a category parents--------------------------------------------------
                     */
                    //requetes a l'intérieur du foreach afin d'avoir la catégorie parent de la catégorie en cours de navigation
                    $requeteSelect = "SELECT * FROM $table WHERE id = $result->category_parent_id";
                    //array $result select crée.
                    $result_select = $wpdb->get_results($requeteSelect);

                    echo "<tr class='list_table'>";
                    echo "<td>$result->name</td>";
                    //si il n'y a pas de catégorie parent il va dans le else et créer un td vide pour pas avoir de décalage dans le tableau.
                    if ($result_select != null) {
                        //foreach dans le array result select pour pouvoir afficher la categorie parent.
                        foreach ($result_select as $parent_category) {
                            echo "<td>$parent_category->name</td>";
                        }
                    } else {
                        echo "<td> - </td>";
                    }
                    //----------------------------------------------------------------------------------------------------


                    $table = $wpdb->prefix . TABLE_NAME_ISI_CATEGORY;
                    $requeteSelectAll = "SELECT * FROM $table";
                    $results_parent_categorys = $wpdb->get_results($requeteSelectAll);
                    echo "<td>
                            
                            <form class='form-settings' method='post' action='" . esc_url(admin_url('admin-post.php')) . "' >
                                <input type='hidden' name='action' value='isi_form_delete_category'/>
                                <input type='hidden' name='category_id' value='$result->id'/> 
                                <input type='hidden' name='category_name_delete' value='$result->name'/>                           
                            <button type='submit' name='submit' onclick='return confirmDelete()'>
                                    <img src=$iconeDelete alt='button delete' width='30'/></button>    
                                    <button type='button' id='modalbtn-category_$i' class='modal-btn'><img src=$iconeModify alt='button modify' width='30' value='$result->id'/></button>
                            </form> 
        
                        <!-- The Modal -->
                                  <div id='myModal-category_$i'  class='isi-modal'>
                                        
                                          <!-- Modal content -->
                                        <div class='modal-content'>
                                              <span id='close-category_$i' class='closeModal'>&times;</span>
                                                <h3>Modifier la catégorie : \" $result->name \"</h3>
                                                
                                              <form method='post' action='" . esc_url(admin_url('admin-post.php')) . "'>
                                              
                                                    <input type='hidden' name='action' value='isi_form_response_modify_category'>
                                                    <input type='hidden' name='category_id' value='$result->id'/>
                                                    
                                                    <label for='category_name'>Nouveau nom : </label>
                                                    <input type='text' name='category_name' id='category_name' value='$result->name' required>"; ?>

                    <label for='category_parent_category'>Parent Category : </label>
                    <select id='category_parent_category' name='category_parent_category'>
                    <?php
                    if (!empty($parent_category)) {
                        echo "<option value=" . $parent_category->id . "> $parent_category->name </option>";

                        foreach ($results_parent_categorys as $result_parent) {
                            if ($result_parent != $parent_category) {
                                echo "<option value=" . $result_parent->id . "> $result_parent->name </option>";
                            }
                        }
                    }

                    if (empty($parent_category)) {
                        echo "<option value='0'>Default</option>";

                        foreach ($results_parent_categorys as $result_parent) {
                            if ($result_parent != $parent_category) {
                                echo "<option value=" . $result_parent->id . "> $result_parent->name </option>";
                            }
                        }

                    }


                    ?>

                    <?php
                    echo "</select>


                                                    <button type='submit' name='submit' class='btn button-primary'>Valider la modification</button>
                                                                                      
                                              </form>

                                        </div>
                                  </div>
        
                        </td>";

                    echo "</tr>";
                }
                ?></table>

        </div>

        <?php
    }
}

/*
 * function for delete a row of the table category
 *
 */
//add action admin-posrt_{action}
add_action('admin_post_isi_form_response_modify_category', 'modify_category');

/**
 * Function modify category
 */
function modify_category()
{
    if (isset($_POST['submit'])) {

        //global wpdb
        global $wpdb;

        //name for table wp_terms
        $table_name_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;

        //table for table wp_term_taxonomy
        $table_name_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;

       //Table for issiforma_category
        $table_name_category = $wpdb->prefix . TABLE_NAME_ISI_CATEGORY;

        /**
         * All input
         * id , name, category parent
         */
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $category_parent = $_POST['category_parent_category'];

        /**
         * Select table wp_term with isiforma_category. where id category
         */

        $sqlSelectCategoryTerm = "SELECT * 
                                  FROM $table_name_isi_wp_term
                                  INNER JOIN $table_name_category
                                  ON $table_name_isi_wp_term.name = $table_name_category.name
                                  WHERE $table_name_category.id = $category_id ";
        $selectThisTerm = $wpdb->get_row($sqlSelectCategoryTerm);

        /**
         * Select al ltable wp_term with isiforma_category where parent category.
         */

        $sqlSelectParentCategoryTerm = "SELECT * 
                                  FROM $table_name_isi_wp_term
                                  INNER JOIN $table_name_category
                                  ON $table_name_isi_wp_term.name = $table_name_category.name
                                  WHERE $table_name_category.id = $category_parent ";
        $selectParentTerm = $wpdb->get_row($sqlSelectParentCategoryTerm);


        /**
         * update category and category parent where id category
         */
        $wpdb->update($table_name_category,
            array(
                'name' => $category_name,
                'category_parent_id' => $category_parent
            ),
            array(
                'id' => $category_id,
            ),
        );


        /**
         * update category on table wp_term
         */
        $wpdb->update($table_name_isi_wp_term, array(
            'name' => $category_name,
            'slug' => strtolower($category_name),
        ),
            array(
                'term_id' => (int)$selectThisTerm->term_id
            ),

        );


        /**
         * update category on table wp_term_taxonomy with id parent and modify parent on children.
         */
        $wpdb->update($table_name_isi_wp_term_taxonomy,
            array(
                'parent' => (int)$selectParentTerm->term_id,
            ),
            array(
                'term_id' => (int)$selectThisTerm->term_id,
            )

        );

        wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}


//add action admin_post_{action} for delete category.
//Delete category on all table wp_term and wp_term_taxonomy for Clean BDD.
add_action('admin_post_isi_form_delete_category', 'delete_category');
function delete_category()
{

    if (isset($_POST['category_id'])) {

        global $wpdb;

        //table terms
        $table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
        //table terms_taxonomy
        $table_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;
        //table category
        $table_delete = $wpdb->prefix . TABLE_NAME_ISI_CATEGORY;
        $id = $_POST['category_id'];
        $nameDelete = $_POST['category_name_delete'];

        //select all informations about this category in the table terms
        $sql = "SELECT * FROM $table_isi_wp_term WHERE `name` = '$nameDelete'";
        $select = $wpdb->get_row($sql);

        /**
         * SQL for select term_taxonomy id where parent.
         */
        $sqlForUpdateChildren = "SELECT * FROM $table_isi_wp_term_taxonomy WHERE `parent` = '$select->term_id'";
        $sqlIdForUpdate = $wpdb->get_results($sqlForUpdateChildren);


        /**
         * SQL for select isiforma_category where category parent id
         */
        $sqlSelectIdCategory = "SELECT * FROM $table_delete WHERE `category_parent_id` = $id";
        $sqlIdForCategoryUpdate = $wpdb->get_results($sqlSelectIdCategory);

        //foreach for update category_parent_id on array last select.

        foreach ($sqlIdForCategoryUpdate as $sqlIdForUpdateCategoryUnit){
            $wpdb->update($table_delete, array(
                'category_parent_id' => null,
            ),
                array(
                    'id' => $sqlIdForUpdateCategoryUnit->id,
            ),
            );
        }


        //delete category in term_taxonomy table
        $wpdb->delete($table_isi_wp_term_taxonomy, array(
            'term_id' => (int)$select->term_id,
        ));

        foreach ($sqlIdForUpdate as $sqlIdForUpdateUnit) {
            //update table term_taxonomy id = parent
            $wpdb->update($table_isi_wp_term_taxonomy, array(
                'parent' => 0,
            ),
                array(
                    'term_id' => (int)$sqlIdForUpdateUnit->term_id,
                ),
            );

        }

        //Delete category in modality_table
        $wpdb->delete($table_delete, array(
                'id' => $id
            )
        );

        //Delete Category in terms_table
        $wpdb->delete($table_isi_wp_term, array(
                'name' => $nameDelete,
            )
        );

        wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}

?>
