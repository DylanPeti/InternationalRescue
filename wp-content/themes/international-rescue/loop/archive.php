<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$cat_title = single_cat_title('', false);


if (have_posts()) {

?>
<body style="position:relative; height: auto;">
    <div class="grid-wrapper">

        <div class="inner">

            <div class="cat-title"><h6><a href="<?php echo get_bloginfo( 'url' ) ?>/news">News</a> > <?php printf(__('%s', 'carrington-jam'), $cat_title); ?></h6></div>
            <div class="clear"></div>
    <?php

        while (have_posts()) {
            the_post();
            cfct_content();
        }

        cfct_misc('nav-posts');

    ?>

        </div>
    </div>
<?php

}

?>
