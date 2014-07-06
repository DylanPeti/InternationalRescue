<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

if (have_posts()) {

?>
    <div class="grid-wrapper contact-page">
        <div class="inner">
    <?php

        while (have_posts()) {
            the_post();
            cfct_custom_content('type-contact');
        }

    ?>
        </div>
    </div>
<?php

}

?>
