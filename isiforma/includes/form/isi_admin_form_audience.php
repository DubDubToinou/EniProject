<?php
function view_form_audience()
{
    //tags for search and audience targeted
    ?>
    <button type="button" class="collapsible">Audience</button>

    <div class="content-isi-form">
        <?php
        list_tags();
        ?>
        <div class="collapse-audience">
        <h3>New Audience</h3>
        <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="isi_form_response_audience">

            <label for="audience_name">Name :</label>
            <input name="audience_name" type="text" id="audience_name" required>

            <button type="submit" name="submit" class="btn button-primary">Validate</button>

        </form>
            </div>
    </div>

    <!--
        Javascript for Collapsible menu.
        change class for collapsible-active and deploy content display block.
     -->
    <script>
        let coll = document.getElementsByClassName("collapsible");
        let i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function () {
                this.classList.toggle("active-collapsible");
                let content = this.nextElementSibling;
                if (content.style.display === "flex") {
                    content.style.display = "none";
                } else {
                    content.style.display = "flex";
                }
            });
        }
    </script>

    <?php

}

add_action('admin_post_isi_form_response_audience', 'insert_audience');

function insert_audience()
{
    if (isset($_POST['submit'])) {

        global $wpdb;

	    $audience_name = $_POST['audience_name'];
        $table_name_audience = $wpdb->prefix . TABLE_NAME_ISI_AUDIENCE;
	    $table_name_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
	    $table_name_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;

	    if (!empty($audience_name)) {

            $wpdb->insert(
                $table_name_audience,
                array(
                    'name' => $audience_name,
                )
            );
		    $wpdb->insert($table_name_wp_term,
			    array(
				    'name' => $audience_name,
				    //todo: voir pour le trim de modality name et supprimer les espaces pour que le slug soit correct
				    'slug' => strtolower($audience_name),
				    'term_group' => 0,
			    )
		    );
		    $lastId = $wpdb->insert_id;
		    $wpdb->insert($table_name_wp_term_taxonomy,
			    array(
				    'term_taxonomy_id' => $lastId,
				    'term_id' => $lastId,
				    'taxonomy' => 'audiencetraining',
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


function list_tags()
{

    global $wpdb;
    $iconeDelete = URL_ICONE_DELETE;
    $iconeModify = URL_ICONE_MODIFY;

    $table = $wpdb->prefix . TABLE_NAME_ISI_AUDIENCE;
    $requete = "SELECT * FROM $table";
    $results_audience = $wpdb->get_results($requete);

    if ($results_audience != null) {

        ?>

        <div class="list-audience">
            <h3>List Level</h3>

            <table>
                <tr>
                    <th>Audience</th>
                    <th>Actions</th>
                </tr>
                <?php
                $i = 0;
                foreach ($results_audience as $result) {
                    $i++;
                    echo "<tr class='list_table'>";
                    echo "<td >$result->name</td>";
                    echo "<td >
                 <form class='form-settings' method='post' action='" . esc_url(admin_url('admin-post.php')) . "' >
                                <input type='hidden' name='action' value='isi_form_delete_audience'/>
                                <input type='hidden' name='audience_id' value='$result->id'/>
                                <input type='hidden' name='audience_name_delete' value='$result->name'/>                             
                            <button type='submit' name='submit' onclick='return confirmDelete()'>
                                    <img src=$iconeDelete alt='button delete' width='30'/></button>    
                                    <button type='button' id='modalbtn-audience_$i' class='modal-btn'><img src=$iconeModify alt='button modify' width='30' value='$result->id'/></button>
                            </form> 
                          
                        
                    
                        <!-- The Modal -->
                                  <div id='myModal-audience_$i'  class='isi-modal'>
                                        
                                          <!-- Modal content -->
                                        <div class='modal-content'>
                                              <span id='close-audience_$i' class='closeModal'>&times;</span>
                                                <h3>Modify funding: \" $result->name \"</h3>
                                                
                                              <form method='post' action='" . esc_url(admin_url('admin-post.php')) . "'>
                                              
                                                    <input type='hidden' name='action' value='isi_form_response_modify_audience'>
                                                    <input type='hidden' name='audience_id' value='$result->id'/>
                                                    <input type='hidden' name='modify_this_name' value='$result->name'>
                                                    
                                                    <label for='audience_name'>New name : </label>
                                                    <input type='text' name='audience_name' id='audience_name' value='$result->name' required>
                                                                                                  
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

add_action('admin_post_isi_form_response_modify_audience', 'modify_audience');
function modify_audience()
{
    if (isset($_POST['submit'])) {
        global $wpdb;

	    $table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
        $table_name_audience = $wpdb->prefix . TABLE_NAME_ISI_AUDIENCE;

        $audience_id = $_POST['audience_id'];
        $audience_name = $_POST['audience_name'];
	    $modify_this_name = $_POST['modify_this_name'];

	    $sqlSelect = "SELECT `term_id` FROM $table_isi_wp_term WHERE `name` = '$modify_this_name'";
	    $idSelectTerm = $wpdb->get_row($sqlSelect);

	    //Update on table isiforma_audience
        $wpdb->update($table_name_audience,
            array(
                'name' => $audience_name,
            ),
            array(
                'id' => $audience_id,
            ),
        );
	    //update on table wp_terms
	    $wpdb->update($table_isi_wp_term, array(
		    'name' => $audience_name,
		    'slug' => strtolower($audience_name),
	    ),
		    array(
			    'term_id' => (int)$idSelectTerm->term_id
		    ),
	    );

        wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}

function enqueue_js_confirm_delete()
{
    wp_register_script('isi_js', plugins_url('../../scripts/confirmDelete.js', __FILE__));
    wp_enqueue_script('isi_js');/*
    /*wp_register_script('isi-js-collapse', plugins_url('/scripts/collapsible.js', __FILE__));
    wp_register_script('isi-js-modals', plugins_url('/scripts/modals.js', __FILE__));
    wp_enqueue_script('isi-js-modals');
    wp_enqueue_script('isi-js-collapse');*/
}

add_action('admin_enqueue_scripts', 'enqueue_js_confirm_delete');

add_action('admin_post_isi_form_delete_audience', 'delete_audience');
/*
 * function to delete a audience.D
 * Deletion in the audience, terms and term_taxonomy table in order to create a link between the input
 * form and the display of audience's list in the template.
 */
function delete_audience()
{

    if (isset($_POST['audience_id'])) {

        global $wpdb;

        //table terms
	    $table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
        //table terms_taxonomy
	    $table_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;
        //table audience
        $table_delete = $wpdb->prefix . TABLE_NAME_ISI_AUDIENCE;

        //retrieval of information via the submission form of the isiforma settings menu
        $id = $_POST['audience_id'];
	    $nameDelete = $_POST['audience_name_delete'];

        //Select term_id from this audience in the terms table
        // term_id reference to the term_taxonomy table
	    $sql = "SELECT * FROM $table_isi_wp_term WHERE `name` = '$nameDelete'";
	    $select = $wpdb->get_row($sql);

        //delete audience in term_taxonomy table
	    $wpdb->delete($table_isi_wp_term_taxonomy, array(
		    'term_id' => (int)$select->term_id,
	    ));

	    //Delete audience in audience_table
        $wpdb->delete($table_delete, array(
                'id' => $id
            )
        );

	    //Delete audience in terms_table
        $wpdb->delete($table_isi_wp_term, array(
                'name'=> $nameDelete
            )
        );

        wp_redirect(URL_ADMIN_ISIFORMA_SETTINGS);
    }
}


