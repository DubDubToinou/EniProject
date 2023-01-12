<?php

function curriculum_training_add_custom_box(){
	add_meta_box(
		'curriculum_training_box_id',
		'Curriculum',
		'curriculum_training_box_html',
		'training',
		'normal',
		'high'

	);
}

add_action ('add_meta_boxes', 'curriculum_training_add_custom_box');

function curriculum_training_box_html(){
	?>
<form>
		<input type="hidden" name="action" value="isi_custom_response_curriculum">
		<select name="monitoring_curriculum_mb" type="text" >
			<option value="curriculum" >Choose an item</option>
		</select>
		<button type="submit" name="submit_curriculum" class="btn button-primary">+ Learning Program</button>
</form>
	<br>
	<form>
		<input type="hidden" name="action" value="isi_custom_response_curriculum_text">
		<select name="monitoring_curriculum_text_mb" type="text" >
			<option value="curriculum_text" >Choose an item</option>
		</select>
		<button type="submit" name="submit_curriculum_text" class="btn button-primary">+ Learning Program</button>
	</form>

	<?php
}