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
//const for training
const TABLE_NAME_ISI_TRAINING = 'isiforma_training';
//const for  place and rooms with equipement.
const TABLE_NAME_ISI_PLACE = 'isiforma_place';
const TABLE_NAME_ISI_ROOM = 'isiforma_room';
const TABLE_NAME_ISI_EQUIPEMENT = 'isiforma_equipement';
//const for relation table options with training . Many TO Many
const TABLE_NAME_REL_ISI_TRAINING_FUNDING = 'isiforma_rel_training_funding';
const TABLE_NAME_REL_ISI_TRAINING_AUDIENCE = 'isiforma_rel_training_tags';
const TABLE_NAME_REL_ISI_TRAINING_MODALITY = 'isiforma_rel_training_modality';
const TABLE_NAME_REL_ISI_TRAINING_LEVEL = 'isiforma_rel_training_level';
const TABLE_NAME_REL_ISI_TRAINING_TYPE = 'isiforma_rel_training_type';
const TABLE_NAME_REL_ISI_TRAINING_CATEGORY = 'isiforma_rel_training_category';
//const for options content training
const TABLE_NAME_ISI_EDUCATIONAL_OBJECTIVES = 'isiforma_educational_objectives';
const TABLE_NAME_ISI_TEACHING_METHODS = 'isiforma_teaching_methods';
const TABLE_NAME_ISI_ASSESSMENT_MODALITY = 'isiforma_assessment_modality';
const TABLE_NAME_ISI_PREREQUISITE = 'isiforma_prerequisite';
const TABLE_NAME_ISI_SCHEDULE = 'isiforma_schedule';
const TABLE_NAME_ISI_ASSESSMENT_METHODS = 'isiforma_assessment_methods';
const TABLE_NAME_ISI_TARGETED_SKILLS = 'isiforma_targeted_skills';
const TABLE_NAME_ISI_PEDAGOGICAL_MEANS = 'isiforma_pedagogical_means';
//const for learning programm
const TABLE_NAME_ISI_LEARNING_PROGRAM = 'isiforma_learning_program';
const TABLE_NAME_ISI_SECTION = 'isiforma_section';
const TABLE_NAME_ISI_LECTURE = 'isiforma_lecture';


//CONST VERSION
const VERSION_TABLE_BDD = "1.0";

//ROLE
const ROLE_ORGANIZATION = "Organization";
const ROLE_ADMINISTRATOR = "administrator";

//CONST URL
const URL_ADMIN_ISIFORMA_SETTINGS = 'admin.php?page=isiforma%2Fadmin-page.php';
define( "URL_ICONE_DELETE", plugin_dir_url( __FILE__ ) . "../assets/img/button_delete.svg" );
define( "URL_ICONE_MODIFY", plugin_dir_url( __FILE__ ) . "../assets/img/button_modify.svg" );
define( "URL_ICONE_ORGANIZATION", plugin_dir_url(__FILE__) . "../assets/img/briefcase.svg");