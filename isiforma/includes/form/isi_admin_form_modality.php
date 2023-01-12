<?php

/**
 * SEE COMMENTS ON ISI_ADMIN_FORM_CATEGORY FOR THIS FILE
 */

function view_form_modality()
{
    //Modality for training: visio/in site...
    ?>
    <button type="button" class="collapsible">Modality</button>
    <div class="content-isi-form" id="collapse-modality">

        <?php
        list_modality();
        ?>

        <h3>New Modality</h3>
        <form method="POST" id="myform" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="isi_form_response_modality">
            <table>
                <tr>
                    <td><label for="modality_name" id="labelName">Name :</label></td>
                    <td><input name="modality_name" type="text" id="modality_name" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" name="submit" class="btn button-primary">Validate</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php


}


add_action('admin_post_isi_form_response_modality', 'insert_modality');

function insert_modality()
{

    if (isset($_POST['submit'])) {

        global $wpdb;

        $modality_name = $_POST['modality_name'];
        $table_name_modality = $wpdb->prefix . TABLE_NAME_ISI_MODALITY;
        $table_name_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
        $table_name_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;


        if (!empty($modality_name)) {
            $wpdb->insert(
                $table_name_modality,
                array(
                    'name' => $modality_name,
                )
            );
            $wpdb->insert($table_name_wp_term,
                array(
                    'name' => $modality_name,
                    //todo: voir pour le trim de modality name et supprimer les espaces pour que le slug soit correct
                    'slug' => strtolower($modality_name),
                    'term_group' => 0,
                )
            );

            $lastId = $wpdb->insert_id;
            $wpdb->insert($table_name_wp_term_taxonomy,
                array(
                    'term_taxonomy_id' => $lastId,
                    'term_id' => $lastId,
                    'taxonomy' => 'modalitytraining',
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
function list_modality()
{

    global $wpdb;
    $iconeDelete = URL_ICONE_DELETE;
    $iconeModify = URL_ICONE_MODIFY;

    $table = $wpdb->prefix . TABLE_NAME_ISI_MODALITY;
    $requete = "SELECT * FROM $table";
    $results_modalitys = $wpdb->get_results($requete);


    if ($results_modalitys != null) {
        ?>
        <h3>List Modality</h3>
        <div>
            <table>
                <tr>
                    <th>Modality</th>
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
                                <input type='hidden' name='action' value='isi_form_delete_modality'/>
                                <input type='hidden' name='modality_id' value='$result->id'/>
                                <input type='hidden' name='modality_name_delete' value='$result->name'/>
                                                           
                            <button type='submit' name='submit' onclick='return confirmDelete()'>
                                    <img src=$iconeDelete alt='button delete' width='30'/></button>    
                                    <button type='button' id='modalbtn-modality_$i' class='modal-btn'><img src=$iconeModify alt='button modify' width='30' value='$result->id'/></button>
                            </form> 
                          
                        
                    
                        <!-- The Modal -->
                                  <div id='myModal-modality_$i'  class='isi-modal'>
                                        
                                          <!-- Modal content -->
                                        <div class='modal-content'>
                                              <span id='close-modality_$i' class='closeModal'>&times;</span>
                                                <h3>Modifier la modality : \" $result->name \"</h3>
                                                
                                              <form method='post' action='" . esc_url(admin_url('admin-post.php')) . "'>
                                              
                                                    <input type='hidden' name='action' value='isi_form_response_modify_modality'>
                                                    <input type='hidden' name='modality_id' value='$result->id'/>
                                                    <input type='hidden' name='modify_this_name' value='$result->name'>
                                                    
                                                    <label for='modality_name'>Nouveau nom : </label>
                                                    <input type='text' name='modality_name' id='modality_name' value='$result->name' required>
                                                    
                                                    <button type='submit' name='submit' class='btn button-primary'>Valider la modification</button>
                                                                                      
                                              </form>

                                        </div>
                                  </div>
               </td>";
                    echo "</tr>";
                }

                ?>
            </table>
        </div>
        <?php
    }

}

/*
 * function for delete a row of the table modality
 *
 */

add_action('admin_post_isi_form_response_modify_modality', 'modify_modality');
function modify_modality()
{
    if (isset($_POST['submit'])) {
        global $wpdb;

        $table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
        $table_name_modality = $wpdb->prefix . TABLE_NAME_ISI_MODALITY;

        $modality_id = $_POST['modality_id'];
        $modality_name = $_POST['modality_name'];
        $modify_this_name = $_POST['modify_this_name'];

        $sqlSelect = "SELECT `term_id` FROM $table_isi_wp_term WHERE `name` = '$modify_this_name'";
        $idSelectTerm = $wpdb->get_row($sqlSelect);
        //Update on table isiforma_modality
        $wpdb->update($table_name_modality,
            array(
                'name' => $modality_name,
            ),
            array(
                'id' => $modality_id,
            ),
        );
        //update on table wp_terms
        $wpdb->update($table_isi_wp_term, array(
            'name' => $modality_name,
            'slug' => strtolower($modality_name),
        ),
            array(
                'term_id' => (int)$idSelectTerm->term_id,
            ),
        );

        wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}


add_action('admin_post_isi_form_delete_modality', 'delete_modality');
/*
 * function for delete a level
 */
function delete_modality()
{
	if (isset($_POST['modality_id'])) {

		global $wpdb;

		//table terms
		$table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
		//table terms_taxonomy
		$table_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;
		//table modality
		$table_delete = $wpdb->prefix . TABLE_NAME_ISI_MODALITY;

		//retrieval of information via the submission form of the isiforma settings menu
		$id = $_POST['modality_id'];
		$nameDelete = $_POST['modality_name_delete'];

        //select all informations about this modality in the table terms
		$sql = "SELECT * FROM $table_isi_wp_term WHERE `name` = '$nameDelete'";
		$select = $wpdb->get_row($sql);

        //delete modality in term_taxonomy table
		$wpdb->delete($table_isi_wp_term_taxonomy, array(
			'term_id' => (int)$select->term_id,
		));

		//Delete modality in modality_table
		$wpdb->delete($table_delete, array(
				'id' => $id
			)
		);
		//Delete modality in terms_table
		$wpdb->delete($table_isi_wp_term, array(
				'name' => $nameDelete,
			)
		);
        //Redirect on page settings isiforma
	    wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}


register_deactivation_hook(__FILE__, 'delete_all_terms_modality');

