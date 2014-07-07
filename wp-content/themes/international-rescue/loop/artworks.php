


<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

if($data) extract($data);

// Next page link
$taxonomy   = get_taxonomy_slug();
$term_slug  = get_term_slug();
$order_name = get_order_name($taxonomy);

$next_query_vars = array(
    'action' => 'artworks_infinite_scroll',
    'order'  => $order_name,
);

if ($taxonomy && $term_slug)
{
    $next_query_vars = array_merge($next_query_vars, array(
        'taxo' => $taxonomy,
        'term' => $term_slug
    ));
}

$next_url = admin_url( 'admin-ajax.php?'.http_build_query($next_query_vars) );

?>

<div class="grid-wrapper artworks-container" data-columns>
    <?php foreach ($artworks as $artwork): ?>
        <?php cfct_custom_content('type-artwork', compact('artwork', 'artworks_link_type')); ?>
    <?php endforeach; ?>

    <a class="next-page hidden" href="<?php echo $next_url ?>"></a>
</div>
