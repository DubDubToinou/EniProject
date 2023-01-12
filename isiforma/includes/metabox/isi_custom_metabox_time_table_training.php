<?php

function time_table_training_add_custom_box(){
	add_meta_box(
		'time_table_training_box_id',
		'Time table',
		'time_table_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'time_table_training_add_custom_box');


function time_table_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_time_table_custom_meta', true);
	?>
    <h3>Time table</h3>

    <label for="time_table_training">Time table</label>
    <textarea style="width: 1000px; height: 100px" name="time_table_training_box" type="text"  id="time_table_training"><?php echo $val ?></textarea>

	<?php
}
add_action( 'save_post', 'save_time_table' );

function save_time_table($post_ID) {

	if ( isset( $_POST['time_table_training_box'] ) ) {
		update_post_meta($post_ID, '_isiwp_time_table_custom_meta', esc_html( $_POST['time_table_training_box']));

	}
}