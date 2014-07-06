<?php

/**
 * Ajax action to get new artworks
 */
function artworks_infinite_scroll_action()
{
    $order_name = $_GET['order'];
    $taxonomy   = $_GET['taxo'];
    $term_slug  = $_GET['term'];

    // Filters
    $filters = array();
    if (in_array($order_name, array(ORDER_DISCIPLINE, ORDER_ARTWORK_TAG)) && $taxonomy && $term_slug)
    {
        $filters = add_artwork_taxonomy_filter($filters, $taxonomy, $term_slug);
        $filters = add_artwork_exclude_filter($filters, get_order_stored_ids($order_name));
    }
    elseif (ORDER_HOME === $order_name)
    {
        $filters = add_artwork_featured_filter($filters);
        $filters = add_artwork_exclude_filter($filters, get_order_stored_ids($order_name));
    }

    // Get artworks
    $artworks = get_random_published_artworks(ARTWORKS_PER_PAGE, $filters);

    // Store order
    store_pods_ids($artworks, $order_name);

    // Template
    cfct_custom_loop('artworks', compact('artworks'));

    die;
}
