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

	$iconeDelete = URL_ICONE_DELETE;
	$iconeModify = URL_ICONE_MODIFY;

	$val = get_post_meta( $post->ID, '_pedagogical_methods_meta', false );

	?>
	<h3>List of Pedagogical Methods</h3>
    <table style="width: 70%; text-align: center">
    <tr>
        <th>Pedagogical Methods</th>
        <th>Action</th>
    </tr>
	<?php
    foreach ($val as $result) {
            echo "<tr >";
            echo "<td>$result</td>";
            echo "<td><button type='submit' name='submit' onclick='return confirmDelete()'>
                                        <img src=$iconeDelete alt='button delete' width='30'/></button>
                                         <button type='button' id='modalbtn-pedagogical-methods' class='modal-btn'><img src=$iconeModify alt='button modify' width='30' value='$result->id'/></button>
                                </td>";
            echo "</tr>";
        }
	?>
    </table>
    <br>
	<!-- New price -->
	<h3>Add a new Pedagogical Methods</h3>
	<!-- New pedagogical methods -->
	<form>
	<input type="hidden" name="action" value="<?php $val ?>">
				<input name="pedagogical_methods_training_mb" type="text" id="pedagogical_methods_training_mb">
		<button type="submit" name="submit_pedagogical_methods_training" class="btn button-primary">Add</button>
    </form>
    <?php

}

add_action('save_post', 'save_methods_pedagogical');

function save_methods_pedagogical($post_ID){

	if ( isset( $_POST['pedagogical_methods_training_mb'] ) ) {
		add_post_meta( $post_ID, '_pedagogical_methods_meta', esc_html( $_POST['pedagogical_methods_training_mb'] ) );
	}
}