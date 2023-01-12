<?php

/**
 * Function for create new custom meta box
 */

function isi_add_custom_meta_box()
{
    add_meta_box(
        'custom_meta_box', // $id
        'Educational Objectives', // $title
        'educational_objectives_training_box_html',
        'training',
       'normal',
        'high'); // $priority

}

//add action for hook add_meta_boxes
add_action('add_meta_boxes', 'isi_add_custom_meta_box');

function educational_objectives_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_educational_objectives_custom_meta', true );
	?>

	<label for="educational_objectives_training"> Educational objectives :</label>
    <textarea style="width: 1000px; height: 100px" name="educational_objectives_box"><?php echo $val?></textarea>


	<?php
}

add_action( 'save_post', 'save_educational_objectives' );

function save_educational_objectives($post_ID){

	if ( isset( $_POST['educational_objectives_box'] ) ) {
		update_post_meta( $post_ID, '_isiwp_educational_objectives_custom_meta', esc_html( $_POST['educational_objectives_box'] ) );
	}

}

