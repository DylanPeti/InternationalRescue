<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

// Default home
get_header();

// Get artwork and relations
$artwork    = find_artwork(get_queried_object_id());

$relations  = get_artwork_relations($artwork);
$artist     = $relations['artist'];
$discipline = $relations['discipline'];

$artist_data   = find_artist($artist['ID']);


// Get current filter for display
list($taxonomy_slug, $term_slug) = get_taxonomy_and_slug_from_params($_GET);

$taxonomy_filter = null;
if ($taxonomy_slug && $term_slug)
{
    $taxonomy_filter = pods($taxonomy_slug, array('where' => 't.name = "'. $term_slug.'"'));
}

// Main gallery
$filters = add_artwork_artist_filter(array(), $artist['post_name']);
$filters = add_artwork_taxonomy_params_filter($filters, $_GET);
$gallery = get_ordered_published_artworks(ARTWORKS_PER_PAGE, $filters);

// Main gallery useful data
$gallery_order = array();
$gallery_ids   = array();
$real_position = 1;
foreach ($gallery as $ga_artwork)
{
    $gallery_order[$ga_artwork->ID] = $real_position;
    $gallery_ids[]                  = $ga_artwork->ID;

    $real_position++;
}

// Same author exluding main gallery, or use random fallback if no artworks
$disciplines = get_artist_disciplines($artist['ID']);

$fallback = true;
if (count($disciplines) > 1)
{
    $same_artist = get_random_published_artworks_by_artist(ARTWORKS_PER_PAGE, $artist['post_name'], $gallery_ids);
    if (count($same_artist) > 0)
    {
        $fallback = false;
    }
}

if ($fallback)
{
    $same_artist = get_random_published_artworks_by_artist(ARTWORKS_PER_PAGE, $artist['post_name']);
}

?>
<!--div id="toggling"></div-->
<div class="grid-wrapper">

    <div class="image-gallery-wrapper" id="gallery-wrapper">

      <?php// print_r($gallery);


	  // foreach ($gallery as $gallery_artwork): 
		// echo $gallery_artwork->media_src."<br>";
	  // endforeach; 
	  //die();

	  ?>
        <div class='slideshow-container' id='slideshow'>
            <div class='slideshow'>
                <?php foreach ($gallery as $gallery_artwork): ?>
                    <?php cfct_custom_content('type-artwork-gallery', array('artwork' => $gallery_artwork)); ?>
                <?php endforeach; ?>
            </div>

            <div class="slide next icon-arrow_right" id="next"></div>
            <div class="slide prev icon-arrow_left" id="prev"></div>
        </div>
		
		
		  <div class="taxo-boxes top">
        <?php if ($taxonomy_filter): ?>
            <?php while ($taxonomy_filter->fetch()): ?>
                <a href="<?php echo get_bloginfo( 'url' ) .'/artwork/discipline/'. $taxonomy_filter->display('slug') ?>"
                   class="btn btn-discipline btn-<?php echo $taxonomy_filter->display('slug')  ?>">
                    <?php echo $taxonomy_filter->display('name') ?>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>

        <div class="artist-header">
            <div class="name"><h1><a href="<?php echo get_bloginfo( 'url' ) .'/artist/'. $artist['post_name'] ?>">
                <?php echo $artist['post_title'] ?></a></h1>
                <span class="position">
                    <span class="current"><?php echo $gallery_order[$artwork->display('ID')] ?></span>
                     /<?php echo count($gallery) ?>
                </span>
            </div>
            <div class="view-profile"> 
				<a href="<?php echo get_bloginfo( 'url' ) .'/artist/'. $artist['post_name'] ?>" class="btn artworkbutton">Artist Profile</a>
                <?php if ($artist_data->field('portfolio.guid')): ?>
                    <a target="_blank" href="<?php echo $artist_data->field('portfolio.guid'); ?>" class="btn btn-download btn-contactir">Download PDF</a>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>

	
    </div>
	
	
    <div class="grid-wrapper" id="more-work" >
        <div class="new-section">
            <h4>More work by <?php echo $artist['post_title']; ?></h4>
        </div>
    </div>
  
    <div class="grid-wrapper artworks-container" id="grid-wrapper" data-columns>
        <?php foreach ($same_artist as $same_artist_artwork): ?>
            <?php cfct_custom_content('type-artwork', array('artwork' => $same_artist_artwork)); ?>
        <?php endforeach; ?>

        <?php if (count($same_artist) > 0): ?>
            <a class="next-page hidden" href="<?php echo $next_url ?>"></a>
        <?php endif; ?>
    </div>
</div>

<?php

get_footer();

?>
<!--script>
$( document ).ready(function() {


 if($(".container").width()>700)
   {
   $( "#header_nav" ).hide('slow');
$( "#toggling" ).click(function() {
$( "#header_nav" ).slideToggle( "slow", function() {});   
$( "#ak" ).toggleClass( "margin", "nomargin" );

});
}
});
</script-->