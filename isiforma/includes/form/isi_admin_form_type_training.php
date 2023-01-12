<?php

/*form for add type for training
Inter / Intra / Tailor-Made
Default on BDD
*/
function view_form_type_training()
{

    ?>
    <button type="button" class="collapsible">Type</button>
    <div class="content-isi-form" id="collapse-type">
			    <?php
			    list_type();
			    ?>
        <h3>New Type :</h3>

        <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">

            <input type="hidden" name="action" value="isi_form_response_type">
            <table>

                <tr>
                    <td><label for="type_training_name">Name :</label></td>
                    <td><input name="type_training_name" type="text" id="type_training_name" required></td>
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

add_action('admin_post_isi_form_response_type', 'insert_type_training');
function insert_type_training()
{

    if (isset($_POST['submit'])) {

        global $wpdb;

	    $type_training_name = $_POST['type_training_name'];

        $table_name_type_training = $wpdb->prefix . TABLE_NAME_ISI_TYPE;
	    $table_name_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
	    $table_name_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;

	    if(!empty($type_training_name)){

	        $wpdb->insert(
		        $table_name_type_training,
		        array(
			        'name' => $type_training_name,
		        )
	        );

		    $wpdb->insert($table_name_wp_term,
			    array(
				    'name' => $type_training_name,
				    //todo: voir pour le trim de modality name et supprimer les espaces pour que le slug soit correct
				    'slug' => strtolower($type_training_name),
				    'term_group' => 0,
			    )
		    );

            $lastId = $wpdb->insert_id;
            $wpdb->insert($table_name_wp_term_taxonomy,
                array(
                    'term_taxonomy_id' => $lastId,
                    'term_id' => $lastId,
                    'taxonomy' => 'typetraining',
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
function list_type() {

	global $wpdb;
	$iconeDelete = URL_ICONE_DELETE;
	$iconeModify = URL_ICONE_MODIFY;

	$table             = $wpdb->prefix . TABLE_NAME_ISI_TYPE;
	$requete           = "SELECT * FROM $table";
	$results_types = $wpdb->get_results( $requete );

    if($results_types != null){
    ?>
	<h3>List type training</h3>
        <div>
            <table>
                <tr>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
    <?php
    $i = 0;
	foreach ( $results_types as $result ) {
		$i ++;
		echo "<tr class='list_table'>";
		echo "<td >$result->name</td>";
		echo "<td >
                  <form class='form-settings' method='post' action='" . esc_url( admin_url( 'admin-post.php' ) ) . "' >
                                <input type='hidden' name='action' value='isi_form_delete_type'/>
                                <input type='hidden' name='type_id' value='$result->id'/>
                                <input type='hidden' name='type_name_delete' value='$result->name'/>                             
                            <button type='submit' name='submit' onclick='return confirmDelete()'>
                                    <img src=$iconeDelete alt='button delete' width='30'/></button>    
                                    <button type='button' id='modalbtn-type_$i' class='modal-btn'><img src=$iconeModify alt='button modify' width='30' value='$result->id'/></button>
                            </form> 
                          
                        <!-- The Modal -->
                                  <div id='myModal-type_$i'  class='isi-modal'>
                                        
                                          <!-- Modal content -->
                                        <div class='modal-content'>
                                              <span id='close-type_$i' class='closeModal'>&times;</span>
                                                <h3>Moditgy type : \" $result->name \"</h3>
                                                
                                              <form method='post' action='" . esc_url( admin_url( 'admin-post.php' ) ) . "'>
                                              
                                                    <input type='hidden' name='action' value='isi_form_response_modify_type'>
                                                    <input type='hidden' name='type_id' value='$result->id'/>
                                                    <input type='hidden' name='modality_name_delete' value='$result->name'/>
                                                     
                                                    <label for='type_name'>New name : </label>
                                                    <input type='text' name='type_name' id='type_name' value='$result->name' required>
                                                    
                                                    <button type='submit' name='submit' class='btn button-primary'>Valider la modification</button>
                                                                                      
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

/*
 * function for modify a row of the table category
 *
 */

add_action( 'admin_post_isi_form_response_modify_type', 'modify_type' );
function modify_type() {

	if ( isset( $_POST['submit'] ) ) {

		global $wpdb;

		$table_name_type = $wpdb->prefix . TABLE_NAME_ISI_TYPE;
		$table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;

		$type_id   = $_POST['type_id'];
		$type_name = $_POST['type_name'];
		$modify_this_name = $_POST['modify_this_name'];

		$sqlSelect = "SELECT `term_id` FROM $table_isi_wp_term WHERE `name` = '$modify_this_name'";
		$idSelectTerm = $wpdb->get_row($sqlSelect);

		//Update on table isiforma_type
		$wpdb->update( $table_name_type,
			array(
				'name' => $type_name,
			),
			array(
				'id' => $type_id,
			),
		);
		//update on table wp_terms
		$wpdb->update($table_isi_wp_term, array(
			'name' => $type_name,
			'slug' => strtolower($type_name),
		),
			array(
				'term_id' => (int)$idSelectTerm->term_id
			),
		);

		wp_redirect( URL_ADMIN_ISIFORMA_SETTINGS );
	}
}

add_action( 'admin_post_isi_form_delete_type', 'delete_type' );
/*
 * function for delete a level
 */
function delete_type() {

	if ( isset( $_POST['type_id'] ) ) {

		global $wpdb;

		//table terms
		$table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
		//table terms_taxonomy
		$table_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;
		//table level
		$table_delete = $wpdb->prefix . TABLE_NAME_ISI_TYPE;

		//retrieval of information via the submission form of the isiforma settings menu
		$id           = $_POST['type_id'];
		$nameDelete = $_POST['type_name_delete'];

		//select all informations about this type in the table terms
		$sql = "SELECT * FROM $table_isi_wp_term WHERE `name` = '$nameDelete'";
		$select = $wpdb->get_row($sql);

		//delete type in term_taxonomy table
		$wpdb->delete($table_isi_wp_term_taxonomy, array(
			'term_id' => (int)$select->term_id,
		));

        //Delete modality in modality_table
		$wpdb->delete( $table_delete, array(
				'id' => $id
			)
		);

		//Delete type in terms_table
		$wpdb->delete($table_isi_wp_term, array(
				'name' => $nameDelete,
			)
		);

		wp_redirect( URL_ADMIN_ISIFORMA_SETTINGS );
	}
}

?>
