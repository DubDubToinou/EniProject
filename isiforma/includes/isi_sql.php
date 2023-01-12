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
$table_name_isi_training = $wpdb->prefix . TABLE_NAME_ISI_TRAINING;
//create table for relation table for training
$table_name_isi_rel_training_funding = $wpdb->prefix . TABLE_NAME_REL_ISI_TRAINING_FUNDING;
$table_name_isi_rel_training_audience = $wpdb->prefix . TABLE_NAME_REL_ISI_TRAINING_AUDIENCE;
$table_name_isi_rel_training_modality = $wpdb->prefix . TABLE_NAME_REL_ISI_TRAINING_MODALITY;
$table_name_isi_rel_training_type = $wpdb->prefix . TABLE_NAME_REL_ISI_TRAINING_TYPE;
$table_name_isi_rel_training_level = $wpdb->prefix . TABLE_NAME_REL_ISI_TRAINING_LEVEL;
$table_name_isi_rel_training_category = $wpdb->prefix . TABLE_NAME_REL_ISI_TRAINING_CATEGORY;
//create table place, rooms and equipment for training.
$table_name_isi_place = $wpdb->prefix . TABLE_NAME_ISI_PLACE;
$table_name_isi_room = $wpdb->prefix . TABLE_NAME_ISI_ROOM;
$table_name_isi_equipement = $wpdb->prefix . TABLE_NAME_ISI_EQUIPEMENT;
//table name for create options content training
$table_name_isi_educational_objectives = $wpdb->prefix . TABLE_NAME_ISI_EDUCATIONAL_OBJECTIVES;
$table_name_isi_teaching_methods = $wpdb->prefix . TABLE_NAME_ISI_TEACHING_METHODS;
$table_name_isi_assessment_modality = $wpdb->prefix . TABLE_NAME_ISI_ASSESSMENT_MODALITY;
$table_name_isi_prerequisite = $wpdb->prefix . TABLE_NAME_ISI_PREREQUISITE;
$table_name_isi_schedule = $wpdb->prefix . TABLE_NAME_ISI_SCHEDULE;
$table_name_isi_assessment_methods = $wpdb->prefix . TABLE_NAME_ISI_ASSESSMENT_METHODS;
$table_name_isi_targeted_skills = $wpdb->prefix . TABLE_NAME_ISI_TARGETED_SKILLS;
$table_name_isi_pedagogical_means = $wpdb->prefix . TABLE_NAME_ISI_PEDAGOGICAL_MEANS;
//table name for create learning programm
$table_name_isi_learning_program = $wpdb->prefix . TABLE_NAME_ISI_LEARNING_PROGRAM;
$table_name_isi_section = $wpdb->prefix . TABLE_NAME_ISI_SECTION;
$table_name_isi_lecture = $wpdb->prefix . TABLE_NAME_ISI_LECTURE;


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
            `name` varchar (25) NOT NULL,
            `description` varchar(200) NOT NULL
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

define("SQL_ISI_CREATE_TRAINING", $sql_create_training = "CREATE TABLE IF NOT EXISTS $table_name_isi_training (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL,
            `price` float (10) NOT NULL,
            `time` time NOT NULL,
            `certification` text NOT NULL,
            `training_organization_id` int(10) NOT NULL
    ) $charset_collate"
);


define("SQL_ISI_CREATE_PLACE", $sql_create_place = "CREATE TABLE IF NOT EXISTS $table_name_isi_place (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL,
            `adress` varchar(30) NOT NULL,
            `cp` varchar(5) NOT NULL,
            `city` varchar(30) NOT NULL,    
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_PLACE_ID_TRAINING_ID FOREIGN KEY $table_name_isi_place(training_id) REFERENCES $table_name_isi_training(id)
    ) $charset_collate"
);

define("SQL_ISI_CREATE_ROOM", $sql_create_room = "CREATE TABLE IF NOT EXISTS $table_name_isi_room (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL,
            `capacity` int(4) NOT NULL,
            `place_id` int(10) NOT NULL,            
            CONSTRAINT FK_ROOM_ID_PLACE_ID FOREIGN KEY $table_name_isi_room(place_id) REFERENCES $table_name_isi_place(id)
    ) $charset_collate"
);

define("SQL_ISI_CREATE_EQUIPEMENT", $sql_create_equipement = "CREATE TABLE IF NOT EXISTS $table_name_isi_equipement (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (20) NOT NULL,
            `room_id` int (10) NOT NULL,
            CONSTRAINT FK_EQUIPEMENT_ID_ROOM_ID FOREIGN KEY $table_name_isi_equipement(room_id) REFERENCES $table_name_isi_room(id)
    ) $charset_collate"
);

define("SQL_ISI_CREATE_REL_TRAINING_AUDIENCE", $sql_create_rel_training_audience = "CREATE TABLE IF NOT EXISTS $table_name_isi_rel_training_audience(
        `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `tags_id` int (10) NOT NULL,
        `training_id` int (10) NOT NULL,
        CONSTRAINT FK_TAG_ID_TRAINIG_ID FOREIGN KEY $table_name_isi_rel_training_audience(tags_id) REFERENCES $table_name_isi_audience(id),
        CONSTRAINT FK_TRAINING_ID_TAG_ID FOREIGN KEY $table_name_isi_rel_training_audience(training_id) REFERENCES $table_name_isi_training(id)
                                
    )$charset_collate"
);

define("SQL_ISI_CREATE_REL_TRAINING_MODALITY", $sql_create_rel_training_modality = "CREATE TABLE IF NOT EXISTS $table_name_isi_rel_training_modality(
        `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `modality_id` int (10) NOT NULL,
        `training_id` int (10) NOT NULL,
        CONSTRAINT FK_MODALITY_ID_TRAINIG_ID FOREIGN KEY $table_name_isi_rel_training_modality(modality_id) REFERENCES $table_name_isi_modality(id),
        CONSTRAINT FK_TRAINING_ID_MODALITY_ID FOREIGN KEY $table_name_isi_rel_training_modality(training_id) REFERENCES $table_name_isi_training(id)
                                
    )$charset_collate"
);

define("SQL_ISI_CREATE_REL_TRAINING_FUNDING", $sql_create_rel_training_funding = "CREATE TABLE IF NOT EXISTS $table_name_isi_rel_training_funding (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `funding_id` int(10) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_FUNDING_ID_TRAINING_ID FOREIGN KEY $table_name_isi_rel_training_funding(funding_id) REFERENCES $table_name_isi_funding(id),
            CONSTRAINT FK_TRAINING_ID_FUNDING_ID FOREIGN KEY $table_name_isi_rel_training_funding(training_id) REFERENCES $table_name_isi_training(id)
    )$charset_collate"
);

define("SQL_ISI_CREATE_REL_TRAINING_TYPE", $sql_create_rel_training_type = "CREATE TABLE IF NOT EXISTS $table_name_isi_rel_training_type(
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `type_id` int(10) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_TYPE_ID_TRAINING_ID FOREIGN KEY $table_name_isi_rel_training_type(type_id) REFERENCES $table_name_isi_type(id),
            CONSTRAINT FK_TRAINING_ID_TYPE_ID FOREIGN KEY $table_name_isi_rel_training_type(training_id) REFERENCES $table_name_isi_training(id)
    )$charset_collate");

define("SQL_ISI_CREATE_REL_TRAINING_LEVEL_REQUIRED", $sql_create_rel_training_level = "CREATE TABLE IF NOT EXISTS $table_name_isi_rel_training_level (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `level_id` int(10) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_LEVEL_ID_TRAINING_ID FOREIGN KEY $table_name_isi_rel_training_level(level_id) REFERENCES $table_name_isi_required_level(id),
            CONSTRAINT FK_TRAINING_ID_LEVEL_ID FOREIGN KEY $table_name_isi_rel_training_level(training_id) REFERENCES $table_name_isi_training(id)
    )$charset_collate");

define("SQL_ISI_CREATE_REL_TRAINING_CATEGORY", $sql_create_rel_training_category = "CREATE TABLE IF NOT EXISTS $table_name_isi_rel_training_category (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `category_id` int(10) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_rel_training_category(category_id) REFERENCES $table_name_isi_category(id),
            CONSTRAINT FK_TRAINING_ID_LEVEL_ID FOREIGN KEY $table_name_isi_rel_training_category(training_id) REFERENCES $table_name_isi_training(id)
    )$charset_collate");

define("SQL_ISI_CREATE_EDUCATIONAL_OBJECTIVES", $sql_create_educational_objectives = "CREATE TABLE IF NOT EXISTS $table_name_isi_educational_objectives (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_educational_objectives(training_id) REFERENCES $table_name_isi_training(id)
        )$charset_collate");

define("SQL_ISI_CREATE_TEACHINGS_METHODS", $sql_create_teachings_methods = "CREATE TABLE IF NOT EXISTS $table_name_isi_teaching_methods (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_teaching_methods(training_id) REFERENCES $table_name_isi_training(id)
        )$charset_collate");

define("SQL_ISI_CREATE_ASSESSMENT_MODALITY", $sql_create_assessment_modality = "CREATE TABLE IF NOT EXISTS $table_name_isi_assessment_modality (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_assessment_modality(training_id) REFERENCES $table_name_isi_training(id)
        )$charset_collate");

define("SQL_ISI_CREATE_PREREQUISITE", $sql_create_prerequisite = "CREATE TABLE IF NOT EXISTS $table_name_isi_prerequisite (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_prerequisite(training_id) REFERENCES $table_name_isi_training(id)
        )$charset_collate");

define("SQL_ISI_CREATE_SCHEDULE", $sql_create_schedule = "CREATE TABLE IF NOT EXISTS $table_name_isi_schedule (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_schedule(training_id) REFERENCES $table_name_isi_training(id)
        )$charset_collate");

define("SQL_ISI_CREATE_ASSESSMENT_METHODS", $sql_create_assessment_methods = "CREATE TABLE IF NOT EXISTS $table_name_isi_assessment_methods (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_assessment_methods(training_id) REFERENCES $table_name_isi_training(id)
        )$charset_collate");

define("SQL_ISI_CREATE_TARGETED_SKILLS", $sql_create_targeted_skills = "CREATE TABLE IF NOT EXISTS $table_name_isi_targeted_skills (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_targeted_skills(training_id) REFERENCES $table_name_isi_training(id)
        )$charset_collate");

define("SQL_ISI_CREATE_PEDAGOGICAL_MEANS", $sql_create_pedagogical_means = "CREATE TABLE IF NOT EXISTS $table_name_isi_pedagogical_means (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_pedagogical_means(training_id) REFERENCES $table_name_isi_training(id)
        )$charset_collate");

define("SQL_ISI_CREATE_LEARNING_PROGRAM", $sql_create_learning_program = "CREATE TABLE IF NOT EXISTS $table_name_isi_learning_program (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `section_id` int(10) NOT NULL
        )$charset_collate");

define("SQL_ISI_CREATE_SECTION", $sql_create_section = "CREATE TABLE IF NOT EXISTS $table_name_isi_section (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `price` float (10) NOT NULL,
            `duration` time NOT NULL,
            `lecture_id` int(10) NOT NULL
        )$charset_collate");

define("SQL_ISI_CREATE_LECTURE", $sql_create_lecture = "CREATE TABLE IF NOT EXISTS $table_name_isi_lecture (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `section_id` int(10) NOT NULL
        )$charset_collate");

define("SQL_ISI_ADD_CONSTRAINT_LEARNING_PROGRAM", $sql_add_constraint_learning_program = "ALTER TABLE IF EXISTS $table_name_isi_learning_program (
    ADD CONSTRAINT FK_LEARNING_PROGRAM_ID_SECTION_ID FOREIGN KEY $table_name_isi_learning_program(section_id) REFERENCES $table_name_isi_section(id)
    )
");

define("SQL_ISI_ADD_CONSTRAINT_SECTION", $sql_add_constraint_section = "ALTER TABLE IF EXISTS $table_name_isi_section (
    CONSTRAINT FK_SECTION_ID_LECTURE_ID FOREIGN KEY $table_name_isi_section(learning_program_id) REFERENCES $table_name_isi_lecture(id)
    )
");

define("SQL_ISI_ADD_CONSTRAINT_LECTURE", $sql_add_constraint_lecture = "ALTER TABLE IF EXISTS $table_name_isi_lecture (
    CONSTRAINT FK_LECTURE_ID_SECTION_ID FOREIGN KEY $table_name_isi_lecture(section_id) REFERENCES $table_name_isi_section(id)
    )
");


// SQL REMOVE
// REMOVE TABLE DEACTIVATION PLUGIN


define("SQL_ISI_REMOVE_REL_TRAINING_FUNDING", "DROP TABLE IF EXISTS $table_name_isi_rel_training_funding");
define("SQL_ISI_REMOVE_REL_TRAINING_TAGS", "DROP TABLE IF EXISTS $table_name_isi_rel_training_audience");
define("SQL_ISI_REMOVE_REL_TRAINING_MODALITY", "DROP TABLE IF EXISTS $table_name_isi_rel_training_modality");
define("SQL_ISI_REMOVE_REL_TRAINING_TYPE", "DROP TABLE IF EXISTS $table_name_isi_rel_training_type");
define("SQL_ISI_REMOVE_REL_TRAINING_LEVEL", "DROP TABLE IF EXISTS $table_name_isi_rel_training_level");
define("SQL_ISI_REMOVE_REL_TRAINING_CATEGORY", "DROP TABLE IF EXISTS $table_name_isi_rel_training_category");
define("SQL_ISI_REMOVE_ORGANIZATION", "DROP TABLE IF EXISTS $table_name_isi_training_organization");
define("SQL_ISI_REMOVE_CATEGORY", "DROP TABLE IF EXISTS $table_name_isi_category");
define("SQL_ISI_REMOVE_MODALITY", "DROP TABLE IF EXISTS $table_name_isi_modality");
define("SQL_ISI_REMOVE_TYPE", "DROP TABLE IF EXISTS $table_name_isi_type");
define("SQL_ISI_REMOVE_REQUIRED_LEVEL", "DROP TABLE IF EXISTS $table_name_isi_required_level");
define("SQL_ISI_REMOVE_AUDIENCE", "DROP TABLE IF EXISTS $table_name_isi_audience");
define("SQL_ISI_REMOVE_FUNDING", "DROP TABLE IF EXISTS $table_name_isi_funding");
define("SQL_ISI_REMOVE_TRAINING", "DROP TABLE IF EXISTS $table_name_isi_training");
define("SQL_ISI_REMOVE_PLACE", "DROP TABLE IF EXISTS $table_name_isi_place");
define("SQL_ISI_REMOVE_ROOM", "DROP TABLE IF EXISTS $table_name_isi_room");
define("SQL_ISI_REMOVE_EQUIPEMENT", "DROP TABLE IF EXISTS $table_name_isi_equipement");
define("SQL_ISI_REMOVE_EDUCATION_OBJECTIVES", "DROP TABLE IF EXISTS $table_name_isi_educational_objectives");
define("SQL_ISI_REMOVE_TEACHING_METHODS", "DROP TABLE IF EXISTS $table_name_isi_teaching_methods");
define("SQL_ISI_REMOVE_ASSESSMENT_MODALITY", "DROP TABLE IF EXISTS $table_name_isi_assessment_modality");
define("SQL_ISI_REMOVE_PREREQUISITE", "DROP TABLE IF EXISTS $table_name_isi_prerequisite");
define("SQL_ISI_REMOVE_SCHEDULE", "DROP TABLE IF EXISTS $table_name_isi_schedule");
define("SQL_ISI_REMOVE_ASSESSMENT_METHODS", "DROP TABLE IF EXISTS $table_name_isi_assessment_methods");
define("SQL_ISI_REMOVE_TARGETED_SKILLS", "DROP TABLE IF EXISTS $table_name_isi_targeted_skills");
define("SQL_ISI_REMOVE_PEDAGOGICAL_MEANS", "DROP TABLE IF EXISTS $table_name_isi_pedagogical_means");
define("SQL_ISI_REMOVE_LEARNING_PROGRAM", "DROP TABLE IF EXISTS $table_name_isi_learning_program");
define("SQL_ISI_REMOVE_SECTION", "DROP TABLE IF EXISTS $table_name_isi_section");
define("SQL_ISI_REMOVE_LECTURE", "DROP TABLE IF EXISTS $table_name_isi_lecture");

