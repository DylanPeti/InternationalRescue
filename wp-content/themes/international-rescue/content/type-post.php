<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

?>

<?php
$category = get_the_category();
$excerpt = get_the_excerpt();

$content =  get_the_content();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
$hasImages = count($matches[0]);
?>

<div class="post-content">

    
    <div class="post-meta">
        <p class="post-category <?php echo $category[0]->slug; ?>"><?php the_category(', '); ?></p>
        <p><?php the_date('j F Y'); ?> <br/><?php the_author(); ?></p>
    </div>
	
	<div class="the-post">
        <h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
		 <?php// the_tags('Tags: ', ', ', '<br />'); ?>
        <?php the_content(); ?>
        <div class="share">
            <a class="icon-facebook_noFrame" target="_blank"
               href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>">
                <span class="visuallyhidden">Share on Facebook</span>
            </a>
            <a class="icon-twitter_noFrame" target="_blank"
               href="https://twitter.com/share?url=<?php the_permalink() ?>">
                <span class="visuallyhidden">Share on Twitter</span>
            </a>
            <?php if ( $hasImages > 0 ) { ?>
            <a class="icon-pinterest_noFrame" target="_blank"
               href="//www.pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&media=<?php echo $matches[1][0] ?>&description=<?php echo $excerpt ?>">
                <span class="visuallyhidden">Share on Pinterest</span>
            </a>
            <?php } ?>
        </div>
    </div>
	
	
	
	
    <div class="clear"></div>
</div>


