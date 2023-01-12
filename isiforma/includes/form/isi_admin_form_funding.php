<?php
function view_form_funding()
{
    //type funding training possible
    ?>
    <button type="button" class="collapsible">Possible Funding</button>
    <div class="content-isi-form">

        <?php
        list_funding();
        ?>

        <h3>New Possible Funding</h3>
        <form method="POST" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="isi_form_response_funding">
            <table>
                <tr>
                    <td><label for="funding_name">Name :</label></td>
                    <td><input name="funding_name" type="text" id="funding_name" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" name="submit_funding" class="btn button-primary">Validate</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}

add_action('admin_post_isi_form_response_funding', 'insert_funding');
function insert_funding()
{

    if (isset($_POST['submit_funding'])) {

        global $wpdb;
	    $funding_name = $_POST['funding_name'];
        $table_name_funding = $wpdb->prefix . TABLE_NAME_ISI_FUNDING;
	    $table_name_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
	    $table_name_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;


        if(!empty($funding_name)){
	        $wpdb->insert(
		        $table_name_funding,
		        array(
			        'name' => $funding_name,

		        )
	        );
	        $wpdb->insert($table_name_wp_term,
		        array(
			        'name' => $funding_name,
			        //todo: voir pour le trim de modality name et supprimer les espaces pour que le slug soit correct
			        'slug' => strtolower($funding_name),
			        'term_group' => 0,
		        )
	        );

	        $lastId = $wpdb->insert_id;
	        $wpdb->insert($table_name_wp_term_taxonomy,
		        array(
			        'term_taxonomy_id' => $lastId,
			        'term_id' => $lastId,
			        'taxonomy' => 'fundingtraining',
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
function list_funding()
{

    global $wpdb;
    $iconeDelete = URL_ICONE_DELETE;
    $iconeModify = URL_ICONE_MODIFY;

    $table = $wpdb->prefix . TABLE_NAME_ISI_FUNDING;
    $requete = "SELECT * FROM $table";
    $results_funding = $wpdb->get_results($requete);

    if ($results_funding != null) {

        ?>
        <h3>List Funding</h3>
        <div>
            <table>
                <tr>
                    <th>Funding</th>

                    <th>Actions</th>
                </tr>
                <?php
                $i = 0;
                foreach ($results_funding as $result) {
                    $i++;

                    echo "<tr class='list_table'>";
                    echo "<td >$result->name</td>";
                    echo "<td >
                <form class='form-settings' method='post' action='" . esc_url(admin_url('admin-post.php')) . "' >
                                <input type='hidden' name='action' value='isi_form_delete_funding'/>
                                <input type='hidden' name='funding_id' value='$result->id'/>
                                <input type='hidden' name='funding_name_delete' value='$result->name'/>                               
                            <button type='submit' name='submit' onclick='return confirmDelete()'>
                                    <img src=$iconeDelete alt='button delete' width='30'/></button>    
                                    <button type='button' id='modalbtn-funding_$i' class='modal-btn'><img src=$iconeModify alt='button modify' width='30' value='$result->id'/></button>
                            </form> 
                          
                        
                    
                        <!-- The Modal -->
                                  <div id='myModal-funding_$i'  class='isi-modal'>
                                        
                                          <!-- Modal content -->
                                        <div class='modal-content'>
                                              <span id='close-funding_$i' class='closeModal'>&times;</span>
                                                <h3>Modify funding: \" $result->name \"</h3>
                                                
                                              <form method='post' action='" . esc_url(admin_url('admin-post.php')) . "'>
                                              
                                                    <input type='hidden' name='action' value='isi_form_response_modify_funding'>
                                                    <input type='hidden' name='funding_id' value='$result->id'/>
                                                    <input type='hidden' name='modify_this_name' value='$result->name'>
                                                    
                                                    <label for='funding_name'>New funding : </label>
                                                    <input type='text' name='funding_name' id='funding_name' value='$result->name' required>
                                                                                      
                                                    <button type='submit' name='submit' class='btn button-primary'>Validate the modification</button>
                                                                                      
                                              </form>

                                        </div>
                                  </div>
        
                        </td>";

                    echo "</tr>";

                } ?>
            </table>
        </div>

        <?php
    }

}

/*
 * function for delete a row of the table funding
 *
 */

add_action('admin_post_isi_form_response_modify_funding', 'modify_funding');
function modify_funding()
{
    if (isset($_POST['submit'])) {
        global $wpdb;

        $table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
        $table_name_funding = $wpdb->prefix . TABLE_NAME_ISI_FUNDING;

        $funding_id = $_POST['funding_id'];
        $funding_name = $_POST['funding_name'];
        $modify_this_name = $_POST['modify_this_name'];

        $sqlSelect = "SELECT `term_id` FROM $table_isi_wp_term WHERE `name` = '$modify_this_name'";
        $idSelectTerm = $wpdb->get_row($sqlSelect);

        $wpdb->update($table_name_funding,
            array(
                'name' => $funding_name,

            ),
            array(
                'id' => $funding_id,
            ),
        );

        $wpdb->update($table_isi_wp_term, array(
            'name' => $funding_name,
            'slug' => strtolower($funding_name),
        ),
            array(
                'term_id' => (int)$idSelectTerm->term_id,
            ),
        );
        wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}

add_action('admin_post_isi_form_delete_funding', 'delete_funding');
/*
 * function for delete a funding
 */
function delete_funding()
{

    if (isset($_POST['funding_id'])) {

        global $wpdb;

	    //table terms
	    $table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
	    //table terms_taxonomy
	    $table_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;
	    //table funding
        $table_delete = $wpdb->prefix . TABLE_NAME_ISI_FUNDING;

	    //retrieval of information via the submission form of the isiforma settings menu
	    $id = $_POST['funding_id'];
	    $nameDelete = $_POST['funding_name_delete'];

	    //select all informations about this funding in the table terms
	    $sql = "SELECT * FROM $table_isi_wp_term WHERE `name` = '$nameDelete'";
	    $select = $wpdb->get_row($sql);

	    //delete funding in term_taxonomy table
	    $wpdb->delete($table_isi_wp_term_taxonomy, array(
		    'term_id' => (int)$select->term_id,
	    ));

	    //Delete funding in funding_table
        $wpdb->delete($table_delete, array(
                'id' => $id
            )
        );

	    //Delete funding in terms_table
	    $wpdb->delete($table_isi_wp_term, array(
			    'name' => $nameDelete,
		    )
	    );

	    wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}

