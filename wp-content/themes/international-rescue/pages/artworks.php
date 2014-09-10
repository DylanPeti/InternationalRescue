<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

$wp_session = WP_Session::get_instance();

// Filtered by taxonomy ?
$taxonomy  = get_taxonomy_slug();
$term_slug = get_term_slug();
$termy=get_term_by('slug', $term_slug, 'discipline');
$termyy=get_term_by('slug', $term_slug, 'artwork_tag');

// Which page are we ? Which stored list of artworks ids choose ?
$order_name = get_order_name($taxonomy);

$taxonomy_filter = null;
if ($taxonomy && $term_slug)
{
    $taxonomy_filter = pods($taxonomy, array('where' => 't.name = "'. $term_slug.'"'));
}
// print_r($taxonomy_filter);
?>
<?php if ($taxonomy_filter): ?>
 <div class="taxo-boxes top taxo-grid termname">
            <span class="btn disabled btn-discipline btn-<?php echo $term_slug;  ?>">
                <?php 
					if($termy->name) { echo $termy->name;}
					if($termyy->name){ echo $termyy->name; }
				?>
            </span>
</div>
<?php endif; ?>
<!--?php if ($taxonomy_filter): ?>
    <!?php while ($taxonomy_filter->fetch()): ?>
        <div class="taxo-boxes top taxo-grid">
            <span class="btn disabled btn-discipline btn-<!?php echo $taxonomy_filter->display('slug')  ?>">
                <!?php echo $taxonomy_filter->display('name') ?>
            </span>
        </div>
    <!?php endwhile; ?>
<!?php endif; ?-->

<?php

// Get artworks
// Use the stored order list from before ?
$get_last_list = (isset($_GET['last_list']) && 'true' == $_GET['last_list']);
if ($get_last_list && isset($wp_session[$order_name]))
{
    $artworks = get_stored_order_published_artworks($wp_session[$order_name]->toArray(), ARTWORKS_PER_PAGE, 1);
}
else
{
    // Filters artworks either by taxonomy or by featured if it is home page
    $filters = ($taxonomy && $term_slug)
        ? add_artwork_taxonomy_filter(array(), $taxonomy, $term_slug)
        : add_artwork_featured_filter(array());

    // Exclude artworks ? For a new batch of n artworks (for infinite scroll for ex)
    $get_next_page = (isset($_GET['next_page']) && true == $_GET['next_page']);
    if ($get_next_page)
    {
        $existing_ids = get_order_stored_ids($order_name);
        $filters = add_artwork_exclude_filter($filters, $existing_ids);
    }

    // Fetch artworks
    $artworks = get_random_published_artworks(ARTWORKS_PER_PAGE, $filters);

    // Store order
    store_pods_ids($artworks, $order_name, true);
}

$artworks_link_type = get_artworks_link_type($taxonomy, $term_slug);

cfct_custom_loop('artworks', compact('artworks', 'artworks_link_type'));

get_footer();

?>
