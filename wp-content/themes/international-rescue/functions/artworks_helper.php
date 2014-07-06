<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

use Models\DataFetcher\ArtworkFetcher;

/**
 * Find artwork by id
 *
 * @param int $id
 *
 * @return bool|\Pods
 */
function find_artwork($id)
{

    return pods(ArtworkFetcher::POST_TYPE_ARTWORK, $id);
}


/**
 * Get artworks taxonomies matches array
 *
 * @return array
 */
function get_artworks_taxonomies_matches()
{
    global $artworkFetcher;

    return $artworkFetcher->getTaxonomyMatching();
}


/**
 * Get random published artworks
 *
 * @param int   $limit
 * @param array $filters
 *
 * @return array
 */
function get_random_published_artworks($limit = 50, $filters = array())
{
    global $artworkFetcher;

    return $artworkFetcher->getRandomPublished($limit, $filters);
}


/**
 * Get ordered published artworks
 *
 * @param int   $limit
 * @param array $filters
 *
 * @return array
 */
function get_ordered_published_artworks($limit = 50, $filters = array())
{
    global $artworkFetcher;

    return $artworkFetcher->getOrderedPublished($limit, $filters);
}

/**
 * Get ordered published artworks
 *
 * @param int    $limit
 * @param string $artist_slug
 * @param array  $exclude
 *
 * @return array
 */
function get_ordered_published_artworks_by_artist($limit = 50, $artist_slug, $exclude = array())
{
    global $artworkFetcher;

    $filters = array();
    $filters = add_artwork_artist_filter($filters, $artist_slug);
    $filters = add_artwork_exclude_filter($filters, $exclude);

    return $artworkFetcher->getOrderedPublished($limit, $filters);
}

/**
 * Get random published artworks
 *
 * @param int    $limit
 * @param string $artist_slug
 * @param array  $exclude
 *
 * @return array
 */
function get_random_published_artworks_by_artist($limit = 50, $artist_slug, $exclude = array())
{
    global $artworkFetcher;

    $filters = array();
    $filters = add_artwork_artist_filter($filters, $artist_slug);
    $filters = add_artwork_exclude_filter($filters, $exclude);

    return $artworkFetcher->getRandomPublished($limit, $filters);
}

/**
 * Get stored order published artworks
 *
 * @param array $ordered_ids_list
 * @param int   $limit
 * @param int   $page
 *
 * @return array
 */
function get_stored_order_published_artworks($ordered_ids_list, $limit = 50, $page = 1)
{
    global $artworkFetcher;

    // Extract portion of list
    if ($limit && $page)
    {
        $offset = ($page - 1) * $limit;
        $ordered_ids_list = array_slice($ordered_ids_list, $offset, $limit);
    }

    $filters = array();
    $filters = add_artwork_id_filter($filters, $ordered_ids_list);

    return $artworkFetcher->getStoredOrderPublished($ordered_ids_list, $filters);
}


/**
 * Add featured filter
 *
 * @param array $filters
 *
 * @return array
 */
function add_artwork_featured_filter(array $filters)
{
    $filters[] = '( '.ArtworkFetcher::FIELD_FEATURED.".meta_value = 1 )";

    return $filters;
}

/**
 * Add artist filter
 *
 * @param array  $filters
 * @param string $artist_slug
 *
 * @return array
 */
function add_artwork_artist_filter(array $filters, $artist_slug)
{
    // ID
    if (is_numeric($artist_slug))
    {
        return add_artwork_artist_id_filter($filters, $artist_slug);
    }

    // Or slug
    $filters[] = "(`".ArtworkFetcher::FIELD_ARTIST."`.post_name = '$artist_slug' )";

    return $filters;
}

/**
 * Add artist id filter
 *
 * @param array $filters
 * @param mixed $artist_id
 *
 * @return array
 */
function add_artwork_artist_id_filter(array $filters, $artist_id)
{
    $filters[] = "(`".ArtworkFetcher::FIELD_ARTIST."`.ID = '$artist_id' )";;

    return $filters;
}

/**
 * Add discipline filter
 *
 * @param array  $filters
 * @param string $discipline_slug
 *
 * @return array
 */
function add_artwork_discipline_filter(array $filters, $discipline_slug)
{
    $filters[ArtworkFetcher::FIELD_DISCIPLINE] = $discipline_slug;

    return $filters;
}
/**
 * Add taxonomy filter
 *
 * @param array $filters
 * @param string $taxonomy
 * @param string $slug
 *
 * @internal param array $exclude
 *
 * @return array
 */
function add_artwork_taxonomy_filter(array $filters, $taxonomy, $slug)
{
    $taxonomies = get_artworks_taxonomies_matches();
    if (array_key_exists($taxonomy, $taxonomies))
    {
        $relation_name = $taxonomies[$taxonomy];
        $filters[$relation_name] = "$relation_name.slug = '$slug'";
    }

    return $filters;
}

/**
 * Add taxonomy filter depending if a taxonomy is in an indexed array
 *
 * @param array $filters
 * @param array $params
 *
 * @return array
 */
function add_artwork_taxonomy_params_filter(array $filters, array $params)
{
    $taxonomy_slug        = null;
    $available_taxonomies = array_keys(get_artworks_taxonomies_matches());
    foreach ($available_taxonomies as $taxo)
    {
        if (isset($params[$taxo]))
        {
            $taxonomy_slug = mysql_real_escape_string($taxo);
            $term_slug     = mysql_real_escape_string($params[$taxo]);
        }
    }

    return ($taxonomy_slug)
        ? add_artwork_taxonomy_filter($filters, $taxonomy_slug, $term_slug)
        : $filters
    ;
}


/**
 * Add exclude filter
 *
 * @param array $filters
 * @param array $exclude
 *
 * @return array
 */
function add_artwork_exclude_filter($filters = array(), array $exclude)
{
    if ($exclude)
    {
        $filters[] = "( t.ID NOT IN (".join(' ,', $exclude).") )";
    }

    return $filters;
}

/**
 * Add exclude filter
 *
 * @param array $filters
 * @param array $ids
 *
 * @return array
 */
function add_artwork_id_filter($filters = array(), array $ids)
{
    if ($ids)
    {
        $filters[] = "( t.ID IN (".join(' ,', $ids).") )";
    }

    return $filters;
}


/**
 * Update published artworks position
 *
 * @param mixed $artist_id
 * @param array $artworks_positions
 *
 * @return array
 */
function update_artworks_order($artist_id, $artworks_positions)
{
    // Get artworks
    $artworks = get_ordered_published_artworks_by_artist(null, $artist_id);
    $artworks_ids = array();
    foreach ($artworks as $artwork)
    {
        $artworks_ids[] = $artwork->ID;
    }


    // Update positions
    $pods = pods( ArtworkFetcher::POST_TYPE_ARTWORK, array('where' => 'ID In ('.join(',', $artworks_ids).')') );
    $ids  = array();
    while ($pods->fetch())
    {
        if (array_key_exists($pods->field('ID'), $artworks_positions))
        {
            $ids[] = $pods->save(array(
                'position' => $artworks_positions[$pods->field('ID')]
            ));
        }
    }

    return $ids;
}

/**
 * Return an array of artwork relations
 *
 * @param PodsAPI $artwork
 *
 * @return array
 */
function get_artwork_relations($artwork)
{
    $artist     = $artwork->field(ArtworkFetcher::FIELD_ARTIST);
    $discipline = $artwork->field(ArtworkFetcher::FIELD_DISCIPLINE);
    $media      = $artwork->field(ArtworkFetcher::FIELD_MEDIA);
    $vimeo_id   = $artwork->field(ArtworkFetcher::FIELD_VIMEO_ID);

    return array(
        'artist'     => $artist,
        'discipline' => $discipline,
        'media'      => $media,
        'vimeo_id'   => $vimeo_id
    );
}

/**
 * Return an array of artwork all relations
 *
 * @param PodsAPI $artwork
 *
 * @return array
 */
function get_artwork_all_relations($artwork)
{
    $data = get_artwork_relations($artwork);
    $data['tags'] = $artwork->field(ArtworkFetcher::FIELD_TAGS);

    return $data;
}