<?php

require_once plugin_dir_path( __FILE__ ) . '../isi_constants.php';
//Main config for plugin. settings first organization

/*
 * function for displaying the form for inserting and modifying organization information
 * this form is in the admin setting menu
 */
function view_form_organization() {

	?>
	<?php
    /*
     * Selects all the informations of the organization if it exists
     * If organization exist -> complete the form with the organization's data "if ( $form_data != null ){echo $form_data->id}"
     */
	global $wpdb;
	$table_name_training_organization = $wpdb->prefix . TABLE_NAME_ISI_TRAINING_ORGANIZATION;
	$form_data                        = $wpdb->get_row( "SELECT * FROM $table_name_training_organization" );
	?>

<!----------------------------------------------Collapse button --------------------------------------------->
    <button type="button" class="collapsible">Organization Settings</button>
    <div class="content-isi-form" id="collapse-organization">

        <!----------form to enter organization information in the admin settings menu isiforma ----------------->
        <!----------all items of this form are required----------------->

        <form class="exemple-pattern-css" method="POST" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="organization_id"
                   value="<?php if ( $form_data != null ) {
				       echo $form_data->id;
			       } ?>">
            <input type="hidden" name="action" value="isi_form_response_training_organization">
            <table>
                <tr>
                    <!--input for the organization name-->
                    <td><label class="label-name-organization" for="organization_name">Name * :</label></td>
                    <td><input name="organization_name" type="text" id="organization_name"
                               value="<?php if ( $form_data != null ) {
						           echo $form_data->name;
					           } ?>" required ></td>
                </tr>

                <tr>
                    <!--input for the organization adress-->
                    <td><label for="organization_adress">Adress * :</label></td>
                    <td><input name="organization_adress" type="text" id="organization_adress"
                               value="<?php if ( $form_data != null )  {
						           echo $form_data->adress;
					           } ?>" required></td>
                <tr>
                    <!--input for the organization postal code-->
                    <!--maxlength of 5 and alpha numeric character accepted-->
                    <td><label for="organization_postal_code">Postal code * :</label></td>
                    <td><input name="organization_postal_code" type="text" id="organization_postal_code" pattern="[A-Za-z0-9]{5}" maxlength="5"
                               value="<?php if ( $form_data != null ) {
						           echo $form_data->cp;
					           } ?>" required></td>
                </tr>
                <tr>
                    <!--input for the organization city-->
                    <td><label for="organization_city">City * :</label></td>
                    <td><input name="organization_city" type="text" id="organization_city"
                               value="<?php if ( $form_data != null ) {
						           echo $form_data->city;
					           } ?>" required></td>
                </tr>
                <tr>
                <tr>
                    <!--input for the organization phone-->
                    <!--maxlength of 10, minlenght of 10, and only numeric characters are accepted-->
                    <td><label for="organization_phone">Phone * :</label></td>
                    <td><input name="organization_phone" type="tel" id="organization_phone"
                               maxlength="10" minlength="10" pattern="(\d){10}"
                               value="<?php if ( $form_data != null ) {
						           echo $form_data->tel;
					           } ?>" required ></td>
                </tr>
                <tr>
                <tr>
                    <!--input for the organization mail-->
                    <!--pattern mail-->

                    <td><label for="organization_mail">Mail * :</label></td>
                    <td><input class="exemple" name="organization_mail" type="email" id="organization_mail"
                               pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})"
                                value="<?php if ( $form_data != null ) {
							       echo $form_data->email;
						       } ?>" required/></td>
                </tr>
                <tr>
                <tr>
                    <!--input for the organization num activity-->

                    <td><label for="oraganization_num_activity">Num Activity * :</label></td>
                    <td><input name="oraganization_num_activity" type="text" id="oraganization_num_activity"
                               value="<?php if ( $form_data != null ) {
						           echo $form_data->num_activity;
					           } ?>" required></td>
                </tr>
                <tr>
                <tr>
                    <!--input for the organization RCS-->
                    <td><label for="organization_rcs">RCS * :</label></td>
                    <td><input name="organization_rcs" type="text" id="organization_rcs"
                               value="<?php if ( $form_data != null ) {
						           echo $form_data->rcs;
					           } ?>" required></td>
                </tr>
                <tr>

                <tr>
                    <!--input for the organization SIRET-->
                    <!-- Pattern : number only
                         maxlength : 14 ; minlength :14 -->

                    <td><label for="organization_siret">SIRET * :</label></td>
                    <td><input name="organization_siret" type="text" id="organization_siret"
                               pattern="[0-9]{14}" maxlength="14" minlength="14"
                               value="<?php if ( $form_data != null ) {
						           echo $form_data->siret;
					           } ?>" required></td>
                </tr>
                <tr>

                <tr>
                    <!--input for the organization Share Capital-->
                    <!--maxlength : 10-->
                    <td><label for="organization_share_capital">Share Capital * :</label></td>
                    <td><input name="organization_share_capital" type="text" id="organization_share_capital"
                               maxlength="10"
                               value="<?php if ( $form_data != null ) {
						           echo $form_data->share_capital;
					           } ?>" required></td>
                </tr>
                <tr>

                    <td></td>
                    <td>
                        <button type="submit" name="submit" class="btn button-primary" onclick="return valider();">Validate</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

	<?php
}

// insert a organzation
add_action( 'admin_post_isi_form_response_training_organization', 'insert_training_organization' );

function insert_training_organization() {

	if (isset( $_POST['submit'] )) {

		global $wpdb;

		$table_name_training_organization = $wpdb->prefix . TABLE_NAME_ISI_TRAINING_ORGANIZATION;

		$organization_id            = $_POST['organization_id'];
		$organization_name          = $_POST['organization_name'];
		$organization_adress        = $_POST['organization_adress'];
		$organization_postal_code   = $_POST['organization_postal_code'];
		$organization_city          = $_POST['organization_city'];
		$organization_phone         = $_POST['organization_phone'];
		$organization_mail          = $_POST['organization_mail'];
		$organization_num_activity  = $_POST['oraganization_num_activity'];
		$organization_rcs           = $_POST['organization_rcs'];
		$organization_siret         = $_POST['organization_siret'];
		$organization_share_capital = $_POST['organization_share_capital'];


		if(!empty($organization_name)
		   && !empty($organization_adress)
		   && !empty($organization_postal_code)
		   && (strlen($organization_postal_code)==5)
		   && !preg_match('/[^a-z_\-0-9]/i', $organization_postal_code)
		   && !empty($organization_city)
		   && !empty($organization_phone)
		   && (strlen($organization_phone)==10)
		   && !preg_match("/[^0-9]/", $organization_phone)
		   && !empty($organization_mail)
		   && filter_var($organization_mail, FILTER_VALIDATE_EMAIL)
		   && !empty($organization_num_activity)
		   && !empty($organization_rcs)
		   && !empty($organization_siret)
		   && (strlen($organization_siret)==14)
		   && !preg_match("/[^0-9]/", $organization_siret)
		   && !empty($organization_share_capital)
		   && (strlen($organization_share_capital)<=10)
		   && !preg_match("/[^0-9]/", $organization_share_capital)){

		$result_update_organization =
			$wpdb->update(
				$table_name_training_organization,
				array(
					'name'          => $organization_name,
					'adress'        => $organization_adress,
					'cp'            => $organization_postal_code,
					'city'          => $organization_city,
					'tel'           => $organization_phone,
					'email'         => $organization_mail,
					'num_activity'  => $organization_num_activity,
					'rcs'           => $organization_rcs,
					'siret'         => $organization_siret,
					'share_capital' => $organization_share_capital
				),
				array(
					'id' => $organization_id,
				),
			);

		if ( $result_update_organization === false || $result_update_organization < 1 ) {


			$wpdb->insert( $table_name_training_organization,
				array(
					'id'            => $organization_id,
					'name'          => $organization_name,
					'adress'        => $organization_adress,
					'cp'            => $organization_postal_code,
					'city'          => $organization_city,
					'tel'           => $organization_phone,
					'email'         => $organization_mail,
					'num_activity'  => $organization_num_activity,
					'rcs'           => $organization_rcs,
					'siret'         => $organization_siret,
					'share_capital' => $organization_share_capital
				),
			);
		}
	}

	}
	wp_redirect( URL_ADMIN_ISIFORMA_SETTINGS );
}

?>

