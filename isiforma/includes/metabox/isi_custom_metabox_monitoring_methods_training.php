<?php

function monitoring_methods_training_add_custom_box(){
	add_meta_box(
		'monitoring_methods_training_box_id',
		'Monitoring methods',
		'monitoring_methods_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'monitoring_methods_training_add_custom_box');

function monitoring_methods_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_monitoring_methods_custom_meta', true );
	?>

    <label for="monitoring_methods_training">Evaluation Methods :</label>
    <textarea style="width: 1000px; height: 100px" name="monitoring_methods_box"><?php echo $val?></textarea>

	<?php
}

add_action( 'save_post', 'save_monitoring_methods' );

function save_monitoring_methods($post_ID){

	if ( isset( $_POST['monitoring_methods_box'] ) ) {
		update_post_meta( $post_ID, '_isiwp_monitoring_methods_custom_meta', esc_html( $_POST['monitoring_methods_box'] ) );
	}
}