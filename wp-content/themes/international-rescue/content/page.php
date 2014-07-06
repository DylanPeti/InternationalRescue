<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

?>

<div class="post-content">
    <div class="the-post">

        <?php the_content(); ?>
    </div>
    <div class="clear"></div>
</div>
