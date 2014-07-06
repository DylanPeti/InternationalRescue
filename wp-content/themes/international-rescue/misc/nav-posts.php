<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
?>
<div class="pagination">
	<span class="previous"><?php previous_posts_link(__('Next &raquo; ', 'carrington-jam')) ?></span>
	<span class="next"><?php next_posts_link(__('&laquo; Previous', 'carrington-jam')) ?></span>
</div>
