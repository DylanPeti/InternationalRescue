<?php

/*
Template Name: Production Template
*/

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
?>
<!--div id="line-production" style="margin-bottom:35px;">
<?php
//cfct_misc('submenu');
?>
</div-->
<script>
$(document).ready(function() {

	$('.container').css('padding-bottom', '110px');
});
</script>
<?php
cfct_loop();

get_footer();

?>
