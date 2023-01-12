<?php

require_once plugin_dir_path(__FILE__) . 'isi_constants.php';

//global wpbd for acces bdd
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();


$table_name_isi_wp_term = $wpdb->prefix . TABLE_NAME_ISI_WP_TERMS;
$table_name_isi_wp_term_taxonomy = $wpdb->prefix . TABLE_NAME_ISI_WP_TERM_TAXONOMY;
//create table for organization training
$table_name_isi_training_organization = $wpdb->prefix . TABLE_NAME_ISI_TRAINING_ORGANIZATION;
$table_name_isi_category = $wpdb->prefix . TABLE_NAME_ISI_CATEGORY;
$table_name_isi_modality = $wpdb->prefix . TABLE_NAME_ISI_MODALITY;
$table_name_isi_type = $wpdb->prefix . TABLE_NAME_ISI_TYPE;
$table_name_isi_required_level = $wpdb->prefix . TABLE_NAME_ISI_REQUIRED_LEVEL;
$table_name_isi_audience = $wpdb->prefix . TABLE_NAME_ISI_AUDIENCE;
$table_name_isi_funding = $wpdb->prefix . TABLE_NAME_ISI_FUNDING;
//create table for relation table for training

//SQL CREATE
//CHARSET FOR BDD


define("SQL_ISI_CREATE_ORGANIZATION", $sql_create_organization = "CREATE TABLE IF NOT EXISTS $table_name_isi_training_organization(
            `id` int(10) NOT NULL UNIQUE PRIMARY KEY,
            `name` varchar (25) NOT NULL,
            `adress` varchar (25) NOT NULL,
            `cp` varchar(5) NOT NULL,
            `city` varchar (100) NOT NULL,
            `tel` varchar (10) NOT NULL,
            `email` varchar (40) NOT NULL,
            `num_activity` int (20) NOT NULL,
            `rcs` varchar (30) NOT NULL,
            `siret` varchar(14) NOT NULL,
            `share_capital` varchar(10) NOT NULL
    ) $charset_collate");

define("SQL_ISI_CREATE_CATEGORY", $sql_create_category = "CREATE TABLE IF NOT EXISTS $table_name_isi_category(
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL,
            `category_parent_id` int(10) NULL,
            CONSTRAINT FK_CATEGORY_ID_CATEGORY_ID FOREIGN KEY $table_name_isi_category(category_parent_id) REFERENCES $table_name_isi_category(id)
    ) $charset_collate");

define("SQL_ISI_INSERT_CATEGORY_DEFAULT", $sql_insert_category_default = "INSERT INTO $table_name_isi_category(
                  `id`,
                  `name`)
                    VALUES ('1','Category Default')"
);

Define("SQL_ISI_INSERT_CATEGORY_DEFAULT_WP_TERM", $sql_insert_category_default_wp_term = "INSERT INTO $table_name_isi_wp_term(
                  `name`, `slug`, `term_group`)
                    VALUES ('Category Default', 'categorydefault', 0)"
);


define("SQL_ISI_CREATE_MODALITY", $sql_create_modality = "CREATE TABLE $table_name_isi_modality (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL
    ) $charset_collate"
);

define("SQL_ISI_CREATE_REQUIRED_LEVEL", $sql_create_required_level = "CREATE TABLE IF NOT EXISTS $table_name_isi_required_level (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL
    ) $charset_collate"
);

define("SQL_ISI_CREATE_TYPE", $sql_create_type = "CREATE TABLE IF NOT EXISTS $table_name_isi_type (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL
    ) $charset_collate"
);

define("SQL_ISI_CREATE_AUDIENCE", $sql_create_audience = "CREATE TABLE IF NOT EXISTS $table_name_isi_audience (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL
    ) $charset_collate"
);

define("SQL_ISI_CREATE_FUNDING", $sql_create_funding = "CREATE TABLE IF NOT EXISTS $table_name_isi_funding (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL          
    ) $charset_collate"
);


// SQL REMOVE
// REMOVE TABLE DEACTIVATION PLUGIN

define("SQL_ISI_REMOVE_ORGANIZATION", "DROP TABLE IF EXISTS $table_name_isi_training_organization");
define("SQL_ISI_REMOVE_CATEGORY", "DROP TABLE IF EXISTS $table_name_isi_category");
define("SQL_ISI_REMOVE_MODALITY", "DROP TABLE IF EXISTS $table_name_isi_modality");
define("SQL_ISI_REMOVE_TYPE", "DROP TABLE IF EXISTS $table_name_isi_type");
define("SQL_ISI_REMOVE_REQUIRED_LEVEL", "DROP TABLE IF EXISTS $table_name_isi_required_level");
define("SQL_ISI_REMOVE_AUDIENCE", "DROP TABLE IF EXISTS $table_name_isi_audience");
define("SQL_ISI_REMOVE_FUNDING", "DROP TABLE IF EXISTS $table_name_isi_funding");