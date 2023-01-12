<?php



function pedagogical_methods_training_add_custom_box(){
	add_meta_box(
		'pedagogical_methods_training_box_id',
		'Pedagogical methods',
		'pedagogical_methods_training_box_html',
		'training',
		'normal',
		'high'

	);
}
add_action ('add_meta_boxes', 'pedagogical_methods_training_add_custom_box');
function pedagogical_methods_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_pedagogical_methods_custom_meta', true);
	?>

    <label for="pedagogical_methods_training">Pedagogical methods</label>
    <textarea style="width: 1000px; height: 100px"name="pedagogical_methods_training_box" type="text"> <?php echo $val ?> Euros</textarea>

	<?php
}
add_action( 'save_post', 'save_pedagogical_methods' );

function save_pedagogical_methods($post_ID){

	if ( isset( $_POST['pedagogical_methods_training_box'] ) ) {
		add_post_meta( $post_ID, '_isiwp_pedagogical_methods_custom_meta', esc_html( $_POST['pedagogical_methods_training_box'] ) );
	}
}