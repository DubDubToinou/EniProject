<?php

/*
 * Add my new menu to the Admin Control Panel
 */

//Files require for function
require_once plugin_dir_path(__FILE__) . 'training_custom.php';
//require_once plugin_dir_path(__FILE__) . 'test-custom-post.php';
require_once plugin_dir_path(__FILE__) . 'form/isi_admin_form_organization.php';
require_once plugin_dir_path(__FILE__) . 'form/isi_admin_form_modality.php';
require_once plugin_dir_path(__FILE__) . 'form/isi_admin_form_type_training.php';
require_once plugin_dir_path(__FILE__) . 'form/isi_admin_form_category.php';
require_once plugin_dir_path(__FILE__) . 'form/isi_admin_form_required_level.php';
require_once plugin_dir_path(__FILE__) . 'form/isi_admin_form_funding.php';
require_once plugin_dir_path(__FILE__) . 'form/isi_admin_form_audience.php';

/**
 * Custom metabox
 */

require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_duration_training.php';
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_prices_training.php';
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_curriculum_training.php';
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_evaluation_methods_training.php';
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_monitoring_methods_training.php';
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_pedagogical_means_training.php';
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_pedagogical_methods_training.php';
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_prerequisites_training.php';
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_skills_targeted_training.php';
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_time_table_training.php';
//add custom meta box
require_once plugin_dir_path(__FILE__) . 'metabox/isi_custom_metabox_educational_objectives.php';

//Hook the 'admin_menu' action hook, run the function named 'isi_Add_Admin_Link()'
add_action('admin_menu', 'isi_add_admin_link');


/**
 * Function for add a new menu on menu admin page.
 */
function isi_add_admin_link()
{

    global $submenu;

    // menu acces for administrator
    $admin = get_role('administrator');

    $admin->add_cap('custom_menu_access');

    //menu general settings
    add_menu_page(
        'isiforma',
        'isiforma',
        'custom_menu_access',
        'isiforma/admin-page.php',
        'isi_admin_page',
        'dashicons-welcome-write-blog',
        100
    );

    //menu for gestion organization
    add_submenu_page(
        'isiforma/admin-page.php',
        esc_html__('Organization', 'isiforma'),
        esc_html__('Organization', 'isiforma'),
        'custom_menu_access',
        'isiforma/admin-page-organization.php',
        'isi_admin_page_organization'
    );

    //menu for gestion planning
    add_submenu_page(
        'isiforma/admin-page.php',
        'Planning',
        'Planning',
        'custom_menu_access',
        'isiforma/admin-page-planning.php',
        'isi_admin_page_planning'
    );

    //menu for add and gestion contact
    add_submenu_page(
        'isiforma/admin-page.php',
        'Contact',
        'Contact',
        'custom_menu_access',
        'isiforma/admin-page-contact.php',
        'isi_admin_page_contact'
    );

    //menu for training
    add_submenu_page(
        'isiforma/admin-page.php',
        'Training',
        'Training',
        'custom_menu_access',
        'isiforma/admin-page-training.php',
        'isi_admin_page_training'

    );


    //menu for session of training
    add_submenu_page(
        'isiforma/admin-page.php',
        'Session',
        'Session',
        'custom_menu_access',
        'isiforma/admin-page-session.php',
        'isi_admin_page_session'

    );

    //menu for place & rooms .
    add_submenu_page(
        'isiforma/admin-page.php',
        'Places & Rooms',
        'Places & Rooms',
        'custom_menu_access',
        'isiforma/admin-page-places-and-rooms.php',
        'isi_admin_page_lieux_et_salles'

    );

    //menu for administrative management and manage documents
    add_submenu_page(
        'isiforma/admin-page.php',
        'Administrative management',
        'Administrative management',
        'custom_menu_access',
        'isiforma/admin-page-administrative-management.php',
        'isi_admin_page_administrative_management'
    );

    $submenu['isiforma/admin-page.php'][0][0] = 'Settings';
}



function isi_admin_page()
{
    ?>
    <!-- Admin page Settings
     General Settings
     Settings for Organization training
     -->
    <div class="content-collapsible-settings">

        <!-- Error message for add. JS -->
        <p id="name_error">Incorrect entry</p>
        <p id="insert_success">Success add !</p>

        <h1>General Settings :</h1>

        <?php
        //call function in files form/admin/organization
        view_form_organization();
        ?>
        <h2>OPTION TRAINING SETTINGS</h2>
        <?php
        view_form_modality();
        view_form_type_training();
        view_form_category();
        view_form_required_level();
        view_form_funding();
        view_form_audience();
        ?>
    </div>

    <!-- SCRIPT JS FOR MODALS MODIFY -->
    <script>

        //create var for queryselector
        let modals = document.querySelectorAll(".isi-modal");
        let buttons = document.querySelectorAll(".modal-btn");
        let spans = document.querySelectorAll(".closeModal");

        //compare button of buttons
        for (const button of buttons) {
            let buttonId = button.id.split('-').pop();

            //compare modal
            for (const modal of modals) {
                let modalId = modal.id.split('-').pop();
                if (buttonId === modalId) {
                    button.onclick = () => {
                        modal.style.display = "block";
                    }

                    //compare span
                    for (const span of spans) {
                        let spandId = span.id.split('-').pop();
                        if (modalId === spandId) {
                            span.onclick = () => {
                                modal.style.display = "none";
                            }
                        }
                    }

                }
            }
        }

    </script>
    <?php
}


add_action ('add_meta_boxes', 'duration_training_add_custom_box');
