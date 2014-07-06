<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

?>

<div class="grid-wrapper error">
    <h3><?php _e('Sorry, we\'re not sure what you\'re looking for here.', 'carrington-jam'); ?></h3>
    <p class="highlight">
        <a  href="<?php echo get_bloginfo('url') ?>">Back to International Rescue Homepage</a>
    </p>
</div>



<?php
get_footer();

?>
