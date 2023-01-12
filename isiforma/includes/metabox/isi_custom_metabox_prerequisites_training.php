<?php

function prerequisites_training_add_custom_box(){
	add_meta_box(
		'prerequisites_training_box_id',
		'Prerequisites',
		'prerequisites_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'prerequisites_training_add_custom_box');

function prerequisites_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_prerequisites_custom_meta', true );
	?>

    <label for="prerequisites_training">Prerequisites :</label>
    <textarea style="width: 1000px; height: 100px" name="prerequisites_box" type="text"><?php echo $val?></textarea>

	<?php
}

add_action( 'save_post', 'save_prerequisites' );

function save_prerequisites($post_ID){

	if ( isset( $_POST['prerequisites_box'] ) ) {
		update_post_meta( $post_ID, '_isiwp_prerequisites_custom_meta', esc_html( $_POST['prerequisites_box'] ) );
	}
}