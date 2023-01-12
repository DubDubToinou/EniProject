<?php


//TABLE NAME WP_POST
const TABLE_NAME_ISI_WP_TERMS = 'terms';
const TABLE_NAME_ISI_WP_TERM_TAXONOMY = 'term_taxonomy';

//CONST FOR CREATE TABLE
//Table Name in BDD MySQL
//const for global training organization
const TABLE_NAME_ISI_TRAINING_ORGANIZATION = "isiforma_training_organization";
//const for options settings training organization
const TABLE_NAME_ISI_CATEGORY = "isiforma_category";
const TABLE_NAME_ISI_MODALITY = "isiforma_modality";
const TABLE_NAME_ISI_REQUIRED_LEVEL = "isiforma_required_level";
const TABLE_NAME_ISI_TYPE = "isiforma_type";
const TABLE_NAME_ISI_AUDIENCE = "isiforma_audience";
const TABLE_NAME_ISI_FUNDING = "isiforma_funding";



//CONST VERSION
const VERSION_TABLE_BDD = "1.0";

//CONST URL
const URL_ADMIN_ISIFORMA_SETTINGS = 'admin.php?page=isiforma%2Fadmin-page.php';
define( "URL_ICONE_DELETE", plugin_dir_url( __FILE__ ) . "../assets/img/button_delete.svg" );
define( "URL_ICONE_MODIFY", plugin_dir_url( __FILE__ ) . "../assets/img/button_modify.svg" );
define( "URL_ICONE_ORGANIZATION", plugin_dir_url(__FILE__) . "../assets/img/briefcase.svg");