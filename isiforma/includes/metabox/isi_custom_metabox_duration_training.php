<?php
/*
 * add_meta_boxes : permet de prévenir wordpress qu'une boite va etre rajouté
 */
add_action( 'add_meta_boxes', 'duration_training_add_custom_box' );
/*
 * meta_boxes initialization
 *
 */
function duration_training_add_custom_box() {
	add_meta_box(
		'duration_training_box_id',
		'Duration',
		'duration_training_box_html',
		'training',
		'normal',
		'high'

	);
}

function duration_training_box_html( $post ) {

	$val = get_post_meta( $post->ID, '_isiwp_duration_custom_meta', true);
    ?>

        <label for="duration_training">Duration :</label>
        <input name="duration_training" type="number" id="duration_training" value="<?php echo $val ?>"> heures

	<?php
}

add_action( 'save_post', 'save_duration' );

function save_duration($post_ID) {

	if ( isset( $_POST['duration_training'] ) ) {
		update_post_meta($post_ID, '_isiwp_duration_custom_meta', esc_html( $_POST['duration_training']));

	}

}







