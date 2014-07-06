<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

?>

<?php
$category = get_the_category();

?>

<div class="post-content">
    <div class="post-meta">
        <p class="<?php echo $category[0]->slug; ?>"><?php the_category(', '); ?></p>
        <p><?php the_date('j F Y'); ?><br/>Posted by: <?php the_author(); ?></p>
    </div>
    <div class="the-post">
        <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
        <?php the_content(); ?>
    </div>



        <div class="share">
            <p>
                <a target="_blank"
                    href="http://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php the_permalink() ?>">
                    Share on Facebook
                </a>
                &#8226;
                <a target="_blank"
                   href="http://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?php the_permalink() ?>">
                    Share on Twitter
                </a>
        </div>
</div>

