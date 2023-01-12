<?php

function skills_targeted_training_add_custom_box(){
	add_meta_box(
		'skills_targeted_training_box_id',
		'Skills targeted',
		'skills_targeted_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'skills_targeted_training_add_custom_box');

function skills_targeted_training_box_html(){
	?>
	<h3>List of Skills Targeted</h3>
	<?php
	/**
	 * Function list_skills_targeted_training for list all skills targeted on table for view form.
	 */
	//TODO
	//list_skills_targeted_training();
	?>
	<!-- New skills targeted -->
	<h3>Add a new skill targeted</h3>
	<!-- Form  -->
<form method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>">
		<input type="hidden" name="action" value="isi_custom_response_skill_targeted">
		<select name="skill_targeted_training_mb" type="text" >
			<option value="skill_targeted" >Choose an item</option>
		</select>
		<button type="submit" name="submit_skill_targeted" class="btn button-primary">Add</button>
</form>
    <?php



}
