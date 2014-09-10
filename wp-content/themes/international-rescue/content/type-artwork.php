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
<div class="item"><?php

//get the artist part of url using php server nah. just get artist
//run url function over post title
//check if server equels such
//then filter


$filter_artist_works_from_profile = $_SERVER[HTTP_HOST];
$check_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$home = "http://stage.internationalrescue.com/";
$dollar = "http://stage.internationalrescue.com/artwork/discipline/illustration/"; 
$dollarOne = "http://stage.internationalrescue.com/artwork/discipline/movingimage/";  
$dollarTwo = "http://stage.internationalrescue.com/artwork/discipline/photography/";   
$dollarThree = "http://stage.internationalrescue.com/artwork/discipline/animation/"; 
$dollarFour = "http://stage.internationalrescue.com/artwork/discipline/storyboards/";      

$tags_url = "http://" . $filter_artist_works_from_profile . "/artist/" . seoUrl($artwork->post_title) . "/?discipline=" . seoUrl("$artwork->discipline_name");


if ($check_url ==  $tags_url){ ?>
   
     <a href="<?php echo $artwork_link . "?discipline=" . $artwork->discipline_slug ?>"> 
<?php 
}elseif($dollar == $check_url || $dollarOne == $check_url || $dollarTwo == $check_url || $dollarThree == $check_url || $dollarFour == $check_url || $home == $check_url){

?>
<a href="<?php echo $artwork_link ?>"> 
 <?php

}

else{ ?>

    <a href="<?php echo $artwork_link . "?discipline=" . $artwork->discipline_slug ?>"> 
     <?php

}

?>


  
     
        <div class="overlay"></div>
        <?php if ($artwork->vimeo_id): ?>
            <div class="icon-enlarge <?php echo $artwork->discipline_slug ?>"><span class="icon play-button"></span></div>
        <?php else: ?>
            <div class="icon-enlarge <?php echo $artwork->discipline_slug  ?>"><span class="icon magnify"></span></div>
        <?php endif; ?>
        <div class="thumbnail">
            <?php if ($artwork->vimeo_id): ?>

                <div class="artwork_type_temp" id="the-img" style="background: url('<?php $image_src ?>')"></div>
                <img src="<?php echo $image_src ?>" alt="<?php echo $image_alt ?>" class="lazy" />
            <?php else: ?>
                <?php echo wp_get_attachment_image( $artwork->media_id, 'thumbnail', false, array('class' => 'attachment-thumbnail lazy', 'id' => 'the-img') ); ?>
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
