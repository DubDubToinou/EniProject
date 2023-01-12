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

function monitoring_methods_training_box_html(){
	?>
	<h3>List of Monitoring Methods</h3>
	<?php
	/**
	 * Function list_monitoring_methods_training for list all monitoring methods on table for view form.
	 */
	//TODO
	//list_monitorings_methods_training();
	?>
	<!-- New monitoring methods -->
	<h3>Add a new Monitoring Methods</h3>
		<!-- Form  -->
	<form method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>">
			<input type="hidden" name="action" value="isi_custom_response_monitoring_methods">
			<select name="monitoring_methods_training_mb" type="text" >
				<option value="monitoring_methods" >Choose an item</option>
			</select>
			<button type="submit" name="submit_monitoring_methods" class="btn button-primary">Add</button>
    </form>
    <?php

}

function list_monitorings_methods_training(){

}