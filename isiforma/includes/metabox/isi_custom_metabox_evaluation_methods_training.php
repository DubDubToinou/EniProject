<?php

function evaluation_methods_training_add_custom_box(){
	add_meta_box(
		'evaluation_methods_training_box_id',
		'Evaluation methods',
		'evaluation_methods_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'evaluation_methods_training_add_custom_box');

function evaluation_methods_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_evaluation_methods_custom_meta', true );
    ?>
	<!-- Add a evaluation methods -->

    <label for="evaluation_methods_training"> Evaluation Methods :</label>
    <textarea style="width: 1000px; height: 100px" name="evaluation_methods_box"><?php echo $val?></textarea>

    <?php
}

add_action( 'save_post', 'save_evaluation_methods' );

function save_evaluation_methods($post_ID){

	if ( isset( $_POST['evaluation_methods_box'] ) ) {
		update_post_meta( $post_ID, '_isiwp_evaluation_methods_custom_meta', esc_html( $_POST['evaluation_methods_box'] ) );
	}
}