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

function pedagogical_means_training_box_html(){
	?>
	<h3>List of Pedagogical Means</h3>
	<?php
	/**
	 * Function list_prices_training for list all prices on table for view form.
	 */
	//TODO
	//list_pedagogical_means_training();
	?>
	<!-- New pedagogical means -->
	<h3>Add a new Pedagogical Means</h3>
	<!-- Form  -->
	<form method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>">
		<input type="hidden" name="action" value="isi_custom_response_pedagogical_means">
		<select name="pedagogical_means_training_mb" type="text" >
			<option value="pedagogical_means" >Choose an item</option>
		</select>
		<button type="submit" name="submit_pedagogical_means" class="btn button-primary">Add</button>
    </form>
    <?php
}

function list_pedagogical_means_training(){

}


