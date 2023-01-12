<?php

function skills_targeted_training_add_custom_box(){
	add_meta_box(
		'skills_targeted_training_box_id',
		'Skills targeted',
		'skills_targeted_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'skills_targeted_training_add_custom_box');

function skills_targeted_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_skills_targeted_custom_meta', true);
	?>

    <label for="skills_targeted_training"> Skills targeted :</label>
    <textarea style="width: 1000px; height: 100px" name="skills_targeted_training_box"  id="skills_targeted_training"><?php echo $val ?></textarea>


	<?php
}
add_action( 'save_post', 'save_skills_targeted' );

function save_skills_targeted($post_ID) {

	if ( isset( $_POST['skills_targeted_training_box'] ) ) {
		update_post_meta($post_ID, '_isiwp_skills_targeted_custom_meta', esc_html( $_POST['skills_targeted_training_box']));

	}
}
