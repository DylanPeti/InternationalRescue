<?php


function column_one_half( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_half column_shortcode">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_half', 'column_one_half');


?>
