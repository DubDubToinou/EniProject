<?php

function pedagogical_means_training_add_custom_box(){
	add_meta_box(
		'pedagogical_means_training_box_id',
		'Pedagogical means',
		'pedagogical_means_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'pedagogical_means_training_add_custom_box');

function pedagogical_means_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_pedagogical_means_custom_meta', true );
	?>


    <label for="pedagogical_means_training">Prerequisites :</label>
    <textarea style="width: 1000px; height: 100px"  name="pedagogical_means_box" type="text"><?php echo $val?></textarea>

	<?php
}

add_action( 'save_post', 'save_pedagogical_means' );

function save_pedagogical_means($post_ID){

	if ( isset( $_POST['pedagogical_means_box'] ) ) {
		update_post_meta( $post_ID, '_isiwp_pedagogical_means_custom_meta', esc_html( $_POST['pedagogical_means_box'] ) );
	}
}


