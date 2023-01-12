<?php
/**
 * Plugin name: Isiforma
 * Description: Plugin de gestion de centre de formation
 * Version: 1.0
 * Author: WebStreet
 * Author URI: www.webstreet.io
 */

//---------------------------------------------------------------------------

/*
 * require_once : ask to retrieve the following files in order to use their content
 * file for function
 * file for constants
 * file for SQL
 */
require_once plugin_dir_path(__FILE__) . 'includes/isi_functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/isi_constants.php';
require_once plugin_dir_path(__FILE__) . 'includes/isi_sql.php';



function enqueue_assets_admin()
{
    wp_register_style('isi', plugins_url('/assets/isi_admin.css', __FILE__));
    wp_enqueue_style('isi');
}

add_action('admin_enqueue_scripts', 'enqueue_assets_admin');


// Create Table
function training_organization_table(): void
{

    global $wpdb;
    global $plugin_isiforma_db_version;
    $plugin_isiforma_db_version = VERSION_TABLE_BDD;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    //query for create table. 28 tables prefix -> isiforma_
    //organization
    dbDelta(SQL_ISI_CREATE_ORGANIZATION);
    //options for organization
    dbDelta(SQL_ISI_CREATE_CATEGORY);
    dbDelta(SQL_ISI_CREATE_MODALITY);
    dbDelta(SQL_ISI_CREATE_REQUIRED_LEVEL);
    dbDelta(SQL_ISI_CREATE_TYPE);
    dbDelta(SQL_ISI_CREATE_AUDIENCE);
    dbDelta(SQL_ISI_CREATE_FUNDING);
    dbDelta(SQL_ISI_CREATE_TRAINING);
    //place and rooms
    dbDelta(SQL_ISI_CREATE_PLACE);
    dbDelta(SQL_ISI_CREATE_ROOM);
    dbDelta(SQL_ISI_CREATE_EQUIPEMENT);
    //query for relation table
    dbDelta(SQL_ISI_CREATE_REL_TRAINING_AUDIENCE);
    dbDelta(SQL_ISI_CREATE_REL_TRAINING_MODALITY);
    dbDelta(SQL_ISI_CREATE_REL_TRAINING_FUNDING);
    dbDelta(SQL_ISI_CREATE_REL_TRAINING_TYPE);
    dbDelta(SQL_ISI_CREATE_REL_TRAINING_LEVEL_REQUIRED);
    dbDelta(SQL_ISI_CREATE_REL_TRAINING_CATEGORY);
    //query for create options content training
    dbDelta(SQL_ISI_CREATE_EDUCATIONAL_OBJECTIVES);
    dbDelta(SQL_ISI_CREATE_TEACHINGS_METHODS);
    dbDelta(SQL_ISI_CREATE_ASSESSMENT_MODALITY);
    dbDelta(SQL_ISI_CREATE_PREREQUISITE);
    dbDelta(SQL_ISI_CREATE_SCHEDULE);
    dbDelta(SQL_ISI_CREATE_ASSESSMENT_METHODS);
    dbDelta(SQL_ISI_CREATE_TARGETED_SKILLS);
    dbDelta(SQL_ISI_CREATE_PEDAGOGICAL_MEANS);
    dbDelta(SQL_ISI_CREATE_LEARNING_PROGRAM);
    dbDelta(SQL_ISI_CREATE_SECTION);
    dbDelta(SQL_ISI_CREATE_LECTURE);

    /**
     * SQL FOR CREATE A CATEGORY DEFAULT ON TABLE ISIFORMA_CATEGORY
     * AND
     * WP_TERMS
     * WP_TERM_TAXONOMY
     * for use on custom post type
     */


    /**
     * var Name for table
     */
    $table_isi_category = $wpdb->prefix . TABLE_NAME_ISI_CATEGORY;
    $table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
    $table_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;


    /**
     * Insert on table isiforma_category
     * Default category
     */
    $wpdb->insert($table_isi_category, array(
        'name' => 'Default Category',
        'category_parent_id' => 0,
    ));

    /**
     * Insert table wp_term category default
     */
    $wpdb->insert($table_isi_wp_term, array(
        'name' => 'Default Category',
        'slug' => 'defaultcategory',
        'term_group' => 0,
    ));

    /**
     * Take last id insert
     */
    $lastId = $wpdb->insert_id;
    $wpdb->insert($table_isi_wp_term_taxonomy, array(
        'term_taxonomy_id' => $lastId,
        'term_id' => $lastId,
        'taxonomy' => 'categorytraining',
        'description' => '',
        'parent' => 0,
        'count' => 0,
    ));


    add_option("isiforma_version", $plugin_isiforma_db_version);

}

function remove_all_table_isiforma(): void
{

    global $wpdb;

    // REQUETE SQL FOR REMOVE TABLE ON DESACTIVATION PLUGIN

    $wpdb->query(SQL_ISI_REMOVE_REL_TRAINING_FUNDING);
    $wpdb->query(SQL_ISI_REMOVE_REL_TRAINING_TAGS);
    $wpdb->query(SQL_ISI_REMOVE_REL_TRAINING_MODALITY);
    $wpdb->query(SQL_ISI_REMOVE_REL_TRAINING_TYPE);
    $wpdb->query(SQL_ISI_REMOVE_REL_TRAINING_LEVEL);
    $wpdb->query(SQL_ISI_REMOVE_REL_TRAINING_CATEGORY);
    $wpdb->query(SQL_ISI_REMOVE_ORGANIZATION);
    $wpdb->query(SQL_ISI_REMOVE_CATEGORY);
    $wpdb->query(SQL_ISI_REMOVE_MODALITY);
    $wpdb->query(SQL_ISI_REMOVE_TYPE);
    $wpdb->query(SQL_ISI_REMOVE_REQUIRED_LEVEL);
    $wpdb->query(SQL_ISI_REMOVE_AUDIENCE);
    $wpdb->query(SQL_ISI_REMOVE_FUNDING);
    $wpdb->query(SQL_ISI_REMOVE_TRAINING);
    $wpdb->query(SQL_ISI_REMOVE_PLACE);
    $wpdb->query(SQL_ISI_REMOVE_ROOM);
    $wpdb->query(SQL_ISI_REMOVE_EQUIPEMENT);
    $wpdb->query(SQL_ISI_REMOVE_EDUCATION_OBJECTIVES);
    $wpdb->query(SQL_ISI_REMOVE_TEACHING_METHODS);
    $wpdb->query(SQL_ISI_REMOVE_ASSESSMENT_MODALITY);
    $wpdb->query(SQL_ISI_REMOVE_PREREQUISITE);
    $wpdb->query(SQL_ISI_REMOVE_SCHEDULE);
    $wpdb->query(SQL_ISI_REMOVE_ASSESSMENT_METHODS);
    $wpdb->query(SQL_ISI_REMOVE_TARGETED_SKILLS);
    $wpdb->query(SQL_ISI_REMOVE_PEDAGOGICAL_MEANS);
    $wpdb->query(SQL_ISI_REMOVE_LEARNING_PROGRAM);
    $wpdb->query(SQL_ISI_REMOVE_SECTION);
    $wpdb->query(SQL_ISI_REMOVE_LECTURE);

    delete_option("plugin_isiforma_db_version");

}
/*
 * this function delete all items in table terms and term_taxonomy at the deactivation of plugin
 */
function remove_all_items_terms_terms_taxonomy(){

	global $wpdb;

	//table terms
	$table_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
	//table terms_taxonomy
	$table_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;

	// peut etre supprimer ce bloc ?
	$modalitytraining = "modalitytraining";
	$categorytraining = "categorytraining";
	$typetraining = "typetraining";
	$leveltraining = "leveltraining";
	$fundinglevel = "fundingtraining";

	//select all id of items in table term_taxonomie
	$sql = "SELECT term_taxonomy_id FROM $table_isi_wp_term_taxonomy WHERE 
                                      `taxonomy` = '$modalitytraining'
                                      	OR `taxonomy` = '$categorytraining'
										OR `taxonomy` = '$typetraining'
										OR `taxonomy` = '$leveltraining'
										OR `taxonomy` = '$fundinglevel' ;";

	$select_all_id_term_taxonomy = $wpdb->get_results($sql);

	//delete all items in the table term
	foreach ($select_all_id_term_taxonomy as $id_terms_taxonomy_id) {
		$wpdb->delete( $table_isi_wp_term, array(
				'term_id' => (int) $id_terms_taxonomy_id->term_taxonomy_id
			)
		);
	}

	//delete all items in the table term_taxonomie
	foreach ($select_all_id_term_taxonomy as $id_terms_taxonomy_id) {
		$wpdb->delete($table_isi_wp_term_taxonomy, array(
			'term_taxonomy_id' => (int)$id_terms_taxonomy_id->term_taxonomy_id
		)
		);

	}

}

//this function delete all the isiform tables when uninstalling the plugin
register_deactivation_hook(__FILE__, 'remove_all_table_isiforma');
//this function delete all the isiform tables when uninstalling the plugin
register_deactivation_hook(__FILE__, 'remove_all_items_terms_terms_taxonomy');
//This function allows you to create all the tables necessary for the proper functioning of the isiforma plugin when it is activated.
register_activation_hook(__FILE__, 'training_organization_table');




