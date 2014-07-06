<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$post_ID = get_the_ID();

$postmeta = get_post_meta($post_ID, 'submenu', true);

//print_r($postmeta);


?>

<div class="grid-wrapper">

    <div class="submenu">
    <?php if ($postmeta == 'production'): ?>
         <?php wp_nav_menu( array( 'theme_location' => 'production_menu' ) ); ?>
    <?php elseif ($postmeta == 'about'): ?>
         <?php wp_nav_menu( array( 'theme_location' => 'about_menu' ) ); ?>
    <?php endif; ?>


    </div>
    <div class="clear"></div>
</div>
