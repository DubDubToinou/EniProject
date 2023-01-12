<?php

add_action ('add_meta_boxes', 'prices_training_add_custom_box');

function prices_training_add_custom_box(){
	add_meta_box(
		'prices_training_box_id',
		'Prices',
		'prices_training_box_html',
		'training',
		'normal',
		'high'

	);
}


function prices_training_box_html($post){

	$val = get_post_meta( $post->ID, '_isiwp_price_custom_meta', true);
    ?>

        <label for="price_training"> Price :</label>
        <input name="price_training_box" type="number"  id="price_training" value="<?php echo $val ?>"> Euros

<!--</form>-->
	<?php
}
add_action( 'save_post', 'save_price' );

function save_price($post_ID) {

	if ( isset( $_POST['price_training_box'] ) ) {
		update_post_meta($post_ID, '_isiwp_price_custom_meta', esc_html( $_POST['price_training_box']));

	}
}




