<?php

function prerequisites_training_add_custom_box(){
	add_meta_box(
		'prerequisites_training_box_id',
		'Prerequisites',
		'prerequisites_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'prerequisites_training_add_custom_box');

function prerequisites_training_box_html(){
	?>
	<h3>List of Prerequisites </h3>
	<?php
	/**
	 * Function list_prerequisites_training for list all prices on table for view form.
	 */
	//TODO
	//list_prerequisites_training();
	?>
	<!-- New pedagogical means -->
	<h3>Add a new Prerequisites</h3>
	<!-- Form  -->
	<form method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>">
		<input type="hidden" name="action" value="isi_custom_response_prerequisites">
		<select name="prerequisites_training_mb" type="text" >
			<option value="prerequisites" >Choose an item</option>
		</select>
		<button type="submit" name="submit_prerequisites" class="btn button-primary">Add</button>
    </form>
    <?php

}
function list_prerequisites_training(){

}