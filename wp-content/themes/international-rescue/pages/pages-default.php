<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
remove_filter ('the_content', 'wpautop'); 
get_header();

cfct_loop();
?>

<?php
get_footer();

?>
