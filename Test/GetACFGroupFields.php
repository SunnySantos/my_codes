<?php

add_shortcode('bird_filter', function() {
	ob_start();

	$group_fields = acf_get_fields('group_64dc5fa934cf1'); // ACF Field Groups key

	if($group_fields) {
		echo '<form id="bird-filter" method="get" action="#">';
		foreach ($group_fields as $value) { // ACF Field
			if($value['type'] == 'select') {
				$label = $value['label'];
				echo '<select>';
				echo "<option selected>$label</option>";
				foreach($value['choices'] as $choiceKey => $choiceValue) {
					echo "<option value='$choiceKey'>$choiceValue</option>";
				}
				echo '</select>';
			}
		}
		echo "</form>";
	}

	return ob_get_clean();
});