<?php
/*
* On utilise une fonction pour créer notre custom post type 'Séries TV'
*/

function wpm_custom_post_type()
{

    // On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
    $labels = array(
        // Le nom au pluriel
        'name' => _x('Trainings', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x('Training', 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name' => __('Training'),
        // Les différents libellés de l'administration
        'all_items' => __('All trainings'),
        'view_item' => __('See the training'),
        'add_new_item' => __('Add a new training'),
        'add_new' => __('Add'),
        'edit_item' => __('Edit a training'),
        'update_item' => __('Update a training'),
        'search_items' => __('Search a training'),
        'not_found' => __('Not Found'),
        'not_found_in_trash' => __('Not found in trash'),

    );

    // On peut définir ici d'autres options pour notre custom post type

    $args = array(
        'label' => __('Training'),
        'description' => __('All Trainings'),
        'labels' => $labels,
        'menu_icon' => 'dashicons-video-alt2', // ajout icon ed e menu
        // On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
        'supports' => array('title', 'author', 'editor' ,'thumbnail', 'revisions', 'custom-fields',),
        /*
        * Différentes options supplémentaires
        */
        'show_in_rest' => false,
        'hierarchical' => false,  // permet d’avoir une relation parent/enfant à la manière de la hiérarchie des catégories si la valeur est « true », ou des étiquettes si la valeur est « false » ;
        'public' => true,  // définit si votre custom post type est visible sur votre site. La valeur par défaut est « true » ;
        'has_archive' => true, // permet de générer des pages d’archives pour le custom post type. La valeur par défaut est « false » ;
        'rewrite' => array('slug' => 'training'), //permet de définir le slug utilisé pour les custom post type. Par exemple ici, si je ne le définis pas, le slug par défaut est monsite.com/seriestv. J’ai préféré opter pour un plus lisible et optimisé pour le référencement naturel.

    );

    // On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
    register_post_type('training', $args);

}

add_action('init', 'wpm_custom_post_type', 0);

// ajout de taxomanie

add_action('init', 'wpm_add_taxonomies', 0);

//On crée 3 taxonomies personnalisées: Année, Réalisateurs et Catégories de série.

function wpm_add_taxonomies()
{

    // Taxonomie modality

    // On déclare ici les différentes dénominations de notre taxonomie qui seront affichées et utilisées dans l'administration de WordPress

    // Modality of training

    $labels_modality_training = array(
        'name' => _x('Modalities', 'taxonomy general name'),
        'singular_name' => _x('Modality', 'taxonomy singular name'),
        'search_items' => __('Search a modality'),
        'popular_items' => __('All Modalitys'),
        'all_items' => __('All Modalitys'),
        'edit_item' => __('Edit a modality'),
        'update_item' => __('Update a modality'),
        'new_item_name' => __('Name of the new modality'),
        'add_or_remove_items' => __('Add or delete a modality'),
        'choose_from_most_used' => __('Choose from the most used categories'),
        'not_found' => __('No modality found'),
        'menu_name' => __('Modality'),

    );

    $args_modality_training = array(
        // Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
        'hierarchical' => true,
        'labels' => $labels_modality_training,
        'show_ui' => true, // ne pas afficher dans le menu
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'modality-training'),
        'capabilities'      => array(
            'assign_terms' => 'manage_options',
            'edit_terms'   => 'god',
            'manage_terms' => 'god',
        ),

    );

    register_taxonomy('modalitytraining', 'training', $args_modality_training);

    //Category of training

    $labels_category_training = array(
        'name' => _x('Categories', 'taxonomy general name'),
        'singular_name' => _x('Category', 'taxonomy singular name'),
        'search_items' => __('Search a Category'),
        'popular_items' => __('All category'),
        'all_items' => __('All category'),
        'edit_item' => __('Edit a category'),
        'update_item' => __('Update a category'),
        'add_new_item' => __('Add a new category'),
        'new_item_name' => __('Name of the new category'),
        'add_or_remove_items' => __('Add or delete a category'),
        'choose_from_most_used' => __('Choose from the most used categories'),
        'not_found' => __('No modality found'),
        'menu_name' => __('Category'),
    );

    $args_category_training = array(
        // Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
        'hierarchical' => true,
        'labels' => $labels_category_training,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'category-training'),
        'capabilities'      => array(
            'assign_terms' => 'manage_options',
            'edit_terms'   => 'god',
            'manage_terms' => 'god',
        ),
    );

    register_taxonomy('categorytraining', 'training', $args_category_training);

    //Type of training

    $labels_type_training = array(
        'name' => _x('Types', 'taxonomy general name'),
        'singular_name' => _x('Type', 'taxonomy singular name'),
        'search_items' => __('Search a type'),
        'popular_items' => __('All types'),
        'all_items' => __('All types'),
        'edit_item' => __('Edit a type'),
        'update_item' => __('Update a type'),
        'add_new_item' => __('Add a new type'),
        'new_item_name' => __('Name of the new type'),
        'add_or_remove_items' => __('Add or delete a type'),
        'choose_from_most_used' => __('Choose from the most used type'),
        'not_found' => __('No type found'),
        'menu_name' => __('Type'),
    );

    $args_type_training = array(
        // Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
        'hierarchical' => true,
        'labels' => $labels_type_training,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'type-training'),
        'capabilities'      => array(
            'assign_terms' => 'manage_options',
            'edit_terms'   => 'god',
            'manage_terms' => 'god',
        ),
    );

    register_taxonomy('typetraining', 'training', $args_type_training);

    //Level of training

    $labels_level_training = array(
        'name' => _x('Levels', 'taxonomy general name'),
        'singular_name' => _x('Level', 'taxonomy singular name'),
        'search_items' => __('Search a level'),
        'popular_items' => __('All levels'),
        'all_items' => __('All levels'),
        'edit_item' => __('Edit a level'),
        'update_item' => __('Update a level'),
        'add_new_item' => __('Add a new level'),
        'new_item_name' => __('Name of the new level'),
        'add_or_remove_items' => __('Add or delete a level'),
        'choose_from_most_used' => __('Choose from the most used level'),
        'not_found' => __('No Level found'),
        'menu_name' => __('Level'),
    );

    $args_level_training = array(
        // Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
        'hierarchical' => true,
        'labels' => $labels_level_training,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'level-training'),
        'capabilities'      => array(
            'assign_terms' => 'manage_options',
            'edit_terms'   => 'god',
            'manage_terms' => 'god',
        ),
    );

    register_taxonomy('leveltraining', 'training', $args_level_training);


    //Founding of training

    $labels_funding_training = array(
        'name' => _x('Fundings', 'taxonomy general name'),
        'singular_name' => _x('Funding', 'taxonomy singular name'),
        'search_items' => __('Search a funding'),
        'popular_items' => __('All fundings'),
        'all_items' => __('All fundings'),
        'edit_item' => __('Edit a funding'),
        'update_item' => __('Update a funding'),
        'add_new_item' => __('Add a new funding'),
        'new_item_name' => __('Name of the new funding'),
        'add_or_remove_items' => __('Add or delete a funding'),
        'choose_from_most_used' => __('Choose from the most used funding'),
        'not_found' => __('No funding found'),
        'menu_name' => __('Funding'),
    );

    $args_funding_training = array(
        // Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
        'hierarchical' => true,
        'labels' => $labels_funding_training,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'funding-training'),'capabilities'      => array(
            'assign_terms' => 'manage_options',
            'edit_terms'   => 'god',
            'manage_terms' => 'god',
        ),
    );

    register_taxonomy('fundingtraining', 'training', $args_funding_training);


    //Audience of training

    $labels_audience_training = array(
        'name' => _x('Audiences', 'taxonomy general name'),
        'singular_name' => _x('Audience', 'taxonomy singular name'),
        'search_items' => __('Search a audience'),
        'popular_items' => __('All audiences'),
        'all_items' => __('All audiences'),
        'edit_item' => __('Edit a audience'),
        'update_item' => __('Update a audience'),
        'add_new_item' => __('Add a new audience'),
        'new_item_name' => __('Name of the new audience'),
        'add_or_remove_items' => __('Add or delete a audience'),
        'choose_from_most_used' => __('Choose from the most used audience'),
        'not_found' => __('No audience found'),
        'menu_name' => __('Audience'),
    );

    $args_audience_training = array(
        // Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
        'hierarchical' => true,
        'labels' => $labels_audience_training,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'audience-training'),
        'capabilities'      => array(
            'assign_terms' => 'manage_options',
            'edit_terms'   => 'god',
            'manage_terms' => 'god',
        ),
    );


    register_taxonomy('audiencetraining', 'training', $args_audience_training);
}

function post_type_disable_gutenberg( $current_status, $post_type ) {
    // AJouter le slug de vos post type dans le array suivant :
    if ( in_array( $post_type, array( 'training' ) ) ) {
        return false;
    }
    return $current_status;
}
add_filter( 'use_block_editor_for_post_type', 'post_type_disable_gutenberg', 10, 2 );




