<?php

/*
Template Name: White Template
*/

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
?>
<body style="position:relative; height: auto;">

<div id="about">
<?php

cfct_misc('submenu');
?>


</div>

<?php
cfct_loop();
get_footer();

?>
