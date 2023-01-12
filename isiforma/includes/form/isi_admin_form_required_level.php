<?php
function view_form_required_level()
{
    //required level for training
    ?>
    <button type="button" class="collapsible">Required Level</button>

    <div class="content-isi-form">

        <?php
        list_required_level();
        ?>
        <div class="form-collapse-required-level">
            <h3>New Required Level</h3>
            <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="isi_form_response_level">

                <label for="required_level_name">Name :</label>
                <input name="required_level_name" type="text" id="required_level_name" required>

                <button type="submit" name="submit" class="btn button-primary">Validate</button>

            </form>

        </div>
    </div>
    <?php
}

add_action('admin_post_isi_form_response_level', 'insert_level');

function insert_level()
{

    if (isset($_POST['submit'])) {

        global $wpdb;

	    $level_name = $_POST['required_level_name'];
        $table_name_level = $wpdb->prefix . TABLE_NAME_ISI_REQUIRED_LEVEL;
	    $table_name_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
	    $table_name_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;


        if (!empty($level_name)) {
            $wpdb->insert(
                $table_name_level,
                array(
                    'name' => $level_name,
                )
            );
	        $wpdb->insert($table_name_wp_term,
		        array(
			        'name' => $level_name,
			        //todo: voir pour le trim de modality name et supprimer les espaces pour que le slug soit correct
			        'slug' => strtolower($level_name),
			        'term_group' => 0,
		        )
	        );

            $lastId = $wpdb->insert_id;
            $wpdb->insert($table_name_wp_term_taxonomy,
                array(
                    'term_taxonomy_id' => $lastId,
                    'term_id' => $lastId,
                    'taxonomy' => 'leveltraining',
                    'description' => '',
                    'parent' => 0,
                    'count' => 0,
                )
            );
        }

            wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
        }

}

/*
 * Function for select all elements of table and place them in a table in settings page
 */
function list_required_level()
{

    global $wpdb;
    $iconeDelete = URL_ICONE_DELETE;
    $iconeModify = URL_ICONE_MODIFY;

    $table = $wpdb->prefix . TABLE_NAME_ISI_REQUIRED_LEVEL;
    $requete = "SELECT * FROM $table";
    $results_modalitys = $wpdb->get_results($requete);

    if ($results_modalitys != null) {
        ?>
        <h3>List Level</h3>
        <div>
            <table>
                <tr>
                    <th>Level</th>
                    <th>Actions</th>
                </tr>
                <?php

                $i = 0;
                foreach ($results_modalitys as $result) {
                    $i++;
                    echo "<tr class='list_table'>";
                    echo "<td >$result->name</td>";
                    echo "<td >
                <form class='form-settings' method='post' action='" . esc_url(admin_url('admin-post.php')) . "' >
                                <input type='hidden' name='action' value='isi_form_response_delete_required_level'/>
                                <input type='hidden' name='level_id' value='$result->id'/>
                                <input type='hidden' name='level_name_delete' value='$result->name'/>                           
                            <button type='submit' name='submit' onclick='return confirmDelete()'>
                                    <img src=$iconeDelete alt='button delete' width='30'/></button>    
                                    <button type='button' id='modalbtn-level_$i' class='modal-btn'><img src=$iconeModify alt='button modify' width='30' value='$result->id'/></button>
                            </form> 
        
                        <!-- The Modal -->
                                  <div id='myModal-level_$i'  class='isi-modal'>
                                        
                                          <!-- Modal content -->
                                        <div class='modal-content'>
                                              <span id='close-level_$i' class='closeModal'>&times;</span>
                                                <h3>Modify Required Level : \" $result->name \"</h3>
                                                
                                              <form method='post' action='" . esc_url(admin_url('admin-post.php')) . "'>
                                              
                                                    <input type='hidden' name='action' value='isi_form_response_modify_required_level'>
                                                    <input type='hidden' name='level_id' value='$result->id'/>
                                                    <input type='hidden' name='modify_this_name' value='$result->name'>
                                                    
                                                    <label for='level_name'>New name : </label>
                                                    <input type='text' name='level_name' id='level_name' value='$result->name' required>
                                                                                                                                                  
                                               
                                                    <button type='submit' name='submit' class='btn button-primary'>Validate modify</button>
                                                                                      
                                              </form>
                                        </div>
                                  </div>
        
                        </td>";

                    echo "</tr>";

                }
                ?> </table>
        </div>

        <?php
    }
}

add_action('admin_post_isi_form_response_modify_required_level', 'modify_required_level');
function modify_required_level()
{
    if (isset($_POST['submit'])) {

        global $wpdb;

	    $table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
        $table_name_required_level = $wpdb->prefix . TABLE_NAME_ISI_REQUIRED_LEVEL;

        $level_id = $_POST['level_id'];
        $level_name = $_POST['level_name'];
	    $modify_this_name = $_POST['modify_this_name'];

	    $sqlSelect = "SELECT `term_id` FROM $table_isi_wp_term WHERE `name` = '$modify_this_name'";
	    $idSelectTerm = $wpdb->get_row($sqlSelect);
	    //Update on table isiforma_modality
        $wpdb->update($table_name_required_level,
            array(
                'name' => $level_name,

            ),
            array(
                'id' => $level_id,
            ),
        );
	    //update on table wp_terms
	    $wpdb->update($table_isi_wp_term, array(
		    'name' => $table_name_required_level,
		    'slug' => strtolower($table_name_required_level),
	    ),
		    array(
			    'term_id' => (int)$idSelectTerm->term_id
		    ),
	    );

        wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}

add_action('admin_post_isi_form_response_delete_required_level', 'delete_required_level');
function delete_required_level()
{

    if (isset($_POST['level_id'])) {

        global $wpdb;

	    //table terms
	    $table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
	    //table terms_taxonomy
	    $table_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;
	    //table level
        $table_delete = $wpdb->prefix . TABLE_NAME_ISI_REQUIRED_LEVEL;

	    //retrieval of information via the submission form of the isiforma settings menu
        $id = $_POST['level_id'];
	    $nameDelete = $_POST['level_name_delete'];

	    //select all informations about this level in the table terms
	    $sql = "SELECT * FROM $table_isi_wp_term WHERE `name` = '$nameDelete'";
	    $select = $wpdb->get_row($sql);

	    //delete level in term_taxonomy table
	    $wpdb->delete($table_isi_wp_term_taxonomy, array(
		    'term_id' => (int)$select->term_id,
	    ));

	    //Delete level in level_table
	    $wpdb->delete($table_delete, array(
			    'id' => $id
		    )
	    );
	    //Delete level in terms_table
	    $wpdb->delete($table_isi_wp_term, array(
			    'name' => $nameDelete,
		    )
	    );

        wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}

?>
