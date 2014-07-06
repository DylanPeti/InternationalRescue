<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

if($data) extract($data);

$main = (get_queried_object_id() === (int) $artwork->ID);
$type = ( ($artwork->vimeo_id) ? 'video' : (($artwork->media_id) ? 'image' : null ));

$url = get_bloginfo( 'url' ) .'/artwork/'.$artwork->post_name;

$width = 1;
$height = 1;
if($type === 'image') {
    list($src, $width, $height) = wp_get_attachment_image_src($artwork->media_id, 'large');

    if(!$width) $width = 1;
    if(!$height) $height = 1;
}

$tags_slugs = explode(',', $artwork->tags_slugs);
$tags_names = explode(',', $artwork->tags_names);

$artwork_link = get_bloginfo( 'url' ) .'/artwork/'.$artwork->post_name;

?>
<div class="slideshow-artwork <?php if ($main): ?>current<?php endif ?>"
    <?php if($src): ?>style="background-image: url('<?php echo $src ?>');"<?php endif ?>
    id="post-<?php echo $artwork->ID ?>"
    data-type="<?php echo $type ?>"
    data-ratio="<?php echo (($type === 'video') ? 16/9 : ($width / $height)) ?>"
    data-position="<?php echo (($main) ? 'centre' : 'right') ?>">

    <?php if ($type === 'video'): ?>

    <div class='inner'>
        <iframe frameborder="0"
            webkitallowfullscreen mozallowfullscreen allowfullscreen
            src="//player.vimeo.com/video/<?php echo $artwork->vimeo_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff">
        </iframe>
    </div>
    <?php endif ?>

    <div class="image-caption">
        <div class="image-info">
            <figcaption>
                <?php if ($artwork->tags_slugs): ?>
                    <div class="tags">
                        <ul>
                            <?php foreach ($tags_slugs as $i => $tag_slug): ?>
                                <li><a href="<?php echo get_bloginfo( 'url' ) .'/artwork/artwork-tag/'.$tag_slug ?>"><?php echo $tags_names[$i] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="caption">
                    <?php echo $artwork->post_content; ?>
                </div>
            </figcaption>
        </div>
		<div class="social-share">
			<ul>
				
				
				 <?php $pinit_url = "http://www.pinterest.com/pin/create/button/"
                        ."?url=$artwork_link"
                        ."&media=$src"
                        ."&description=$artwork->post_content"
                    ?>

                <a target="_blank" data-pin-do="buttonPin" data-pin-config="above" href="<?php echo $pinit_url ?>">
				<li class="piicon"></li></a>
				<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>&amp;p[images][0]=<?php echo $src ?>">
					<li class="fblicon"></li></a>
				<a href="mailto:?subject=International Rescue artwork&amp;body=Artwork by <?php echo $artwork->artist_name; ?>. Link: <?php echo $url; ?>">
                  <li class="emailicon"> </li></a>
			</ul>
		</div>	

        <!--div class="social-share">
            <ul class="share">
                <a class="icon-bubble_noFrame"
                       href="mailto:?subject=International Rescue artwork&amp;body=Artwork by <?php echo $artwork->artist_name; ?>. Link: <?php echo $url; ?>">
					   <li class="myicon-email">
                    
                         </li>
                    </a>
              
                <?php if ($type === 'image'): ?>
                <li>
                    <a class="icon-facebook_noFrame" target="_blank"
                       href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>&amp;p[images][0]=<?php echo $src ?>">
                        <span class="visuallyhidden">Share on Facebook</span>
                    </a>
                </li>
                <?php elseif ($type === 'video'): ?>
                    <li>
                        <a class="icon-facebook_noFrame" target="_blank"
                           href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>">
                            <span class="visuallyhidden">Share on Facebook</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($type === 'image'): ?>
                <li>

                    <?php $pinit_url = "http://www.pinterest.com/pin/create/button/"
                        ."?url=$artwork_link"
                        ."&media=$src"
                        ."&description=$artwork->post_content"
                    ?>

                    <a class="icon-pinterest_noFrame" target="_blank"
                        data-pin-do="buttonPin"
                        data-pin-config="above"
                        href="<?php echo $pinit_url ?>">
                        <span class="visuallyhidden">Share on Pinterest</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div-->
    </div>
</div>
