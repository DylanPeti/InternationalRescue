<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

if($data) extract($data);

// Link to single page... Close your eyes
$artwork_link = get_bloginfo( 'url' ) .'/artwork/'.$artwork->post_name;

// Home page
if ('discipline' === $artworks_link_type)
{
    $artwork_link .= '?discipline='.$artwork->discipline_slug;
}
// Other
elseif (strpos($artworks_link_type, '='))
{
    // Get tags slug
    $tags_slugs = explode(',', $artwork->tags_slugs);

    $filter = explode('=', $artworks_link_type);
    if (2 === count($filter))
    {
        if ('artwork_tag' === $filter[0] && in_array($filter[1], $tags_slugs))
        {
            $artwork_link .= '?'.$artworks_link_type;
        }
        elseif ('discipline' === $filter[0] && $artwork->discipline_slug === $filter[1])
        {
            $artwork_link .= '?'.$artworks_link_type;
        }
    }

}

// Thumbnail
if ($artwork->vimeo_id)
{
    $hash      = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$artwork->vimeo_id.".php"));
    $image_src = $hash[0]['thumbnail_large'];
    $image_alt = $hash[0]['title'];
}


?>

<div class="item">
    <a href="<?php echo $artwork_link ?>">
        <div class="overlay"></div>
        <?php if ($artwork->vimeo_id): ?>
            <div class="icon-enlarge <?php echo $artwork->discipline_slug ?>"><span class="icon play-button"></span></div>
        <?php else: ?>
            <div class="icon-enlarge <?php echo $artwork->discipline_slug  ?>"><span class="icon magnify"></span></div>
        <?php endif; ?>
        <div class="thumbnail">
            <?php if ($artwork->vimeo_id): ?>
                <img src="<?php echo $image_src ?>" alt="<?php echo $image_alt ?>" class="lazy" />
            <?php else: ?>
                <?php echo wp_get_attachment_image( $artwork->media_id, 'thumbnail', false, array('class' => 'attachment-thumbnail lazy') ); ?>
            <?php endif; ?>
        </div>
    </a>
    <div class="artist-name">
        <?php if ($artwork->artist_id): ?>
            <h6>
                <!--a class="<!?php echo $artwork->discipline_slug ?>"
                    href="<!?php echo get_bloginfo( 'url' ) ."/artist/".$artwork->artist_slug ?>"-->
				<a href="<?php echo $artwork_link ?>">	
                    <?php echo $artwork->artist_name ?>
                </a>
            </h6>
        <?php endif; ?>
    </div>
</div>
