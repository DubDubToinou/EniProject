<?php

function curriculum_training_add_custom_box(){
	add_meta_box(
		'curriculum_training_box_id',
		'Curriculum',
		'curriculum_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'curriculum_training_add_custom_box');

function curriculum_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_curriculum_custom_meta', true );
	?>

    <label for="curriculum_training">Curriculum :</label>
    <textarea style="width: 1000px; height: 100px" name="curriculum_box" ><?php echo $val?></textarea>

	<?php
}

add_action( 'save_post', 'save_curriculum' );

function save_curriculum($post_ID){

	if ( isset( $_POST['curriculum_box'] ) ) {
		update_post_meta( $post_ID, '_isiwp_curriculum_custom_meta', esc_html( $_POST['curriculum_box'] ) );
	}
}