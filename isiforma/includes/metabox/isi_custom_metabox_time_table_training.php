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

function time_table_training_box_html(){
	?>
	<h3>List of Times</h3>

	<?php
	/**
	 * Function list_timetable_training for list all prices on table for view form.
	 */
	//TODO
	//list_timetable_training();
	?>
	<!-- New TimeTable -->
	<h3>Add a new TimeTable</h3>
	<!-- Form  -->
<form method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>">
		<input type="hidden" name="action" value="isi_custom_response_timetable">
		<select name="timetable_start_training_mb" type="text" >
			<option value="timetable" >Start</option>
		</select>
		<select name="timetable_end_training_mb" type="text" >
			<option value="timetable" >End</option>
		</select>
		<button type="submit" name="submit_timetable" class="btn button-primary">Add</button>
</form>
    <?php

}

function list_timetable_training(){

}