<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

cfct_loop();

?>

<div class="pagination_single">
	<span class="next"><?php previous_post_link('%link', '&laquo; Older') ?></span>
	<span class="previous"><?php next_post_link('%link', 'Newer &raquo;') ?></span>
</div>

<?php


get_footer();

?>
