<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

use Models\DataFetcher\DisciplineFetcher;
use Models\DataFetcher\ArtworkTagFetcher;
use Models\DataFetcher\ArtistFetcher;
use Models\DataFetcher\ArtworkFetcher;

$disciplineFetcher = new DisciplineFetcher();
$artworkTagFetcher = new ArtworkTagFetcher();
$artistFetcher     = new ArtistFetcher();
$artworkFetcher    = new ArtworkFetcher();

include_once(STYLESHEETPATH . '/functions/artworks_helper.php');


/**
 * @return string|null
 */
function get_taxonomy_slug()
{
    $content_object = get_queried_object();

    return ($content_object->taxonomy) ? $content_object->taxonomy : null;
}

/**
 * @return string|null
 */
function get_term_slug()
{
    $content_object = get_queried_object();

    return ($content_object->slug) ? $content_object->slug : null;
}

/**
 * Get taxonomy and slug from array of params
 *
 * @param $params
 *
 * @return array
 */
function get_taxonomy_and_slug_from_params($params)
{
    $taxonomy_slug = null;
    $term_slug     = null;
    $available_taxonomies = array_keys(get_artworks_taxonomies_matches());
    foreach ($available_taxonomies as $taxo)
    {
        if (isset($params[$taxo]))
        {
            $taxonomy_slug = $taxo;
            $term_slug     = $params[$taxo];
            break;
        }
    }

    return array($taxonomy_slug, $term_slug);
}

/**
 * Return a key value array from an iterator
 *
 * @param mixed  $iterable
 * @param string $value
 * @param string $key
 *
 * @return array
 */
function get_key_value_array($iterable, $value, $key = null)
{
    $list = array();

    if ((is_array($iterable) || $iterable instanceof Traversable && $iterable instanceof ArrayAccess))
    {

        if (null === $key)
        {
            foreach ($iterable as $arrayAccess)
            {
                $list[] = $arrayAccess[$value];
            }
        }
        else
        {
            foreach ($iterable as $arrayAccess)
            {
                $list[$arrayAccess[$key]] = $arrayAccess[$value];
            }
        }
    }


    return $list;
}

/**
 * Get artwork link type
 *
 * @param string $taxonomy
 * @param string $term_slug
 *
 * @return string
 */
function get_artworks_link_type($taxonomy, $term_slug)
{
    if (is_front_page())
    {
        return 'discipline';
    }
    elseif ($taxonomy)
    {
        return $taxonomy . '=' . $term_slug;
    }
    else
    {
        return '';
    }
}


/**
 * Get order name depending of existing taxonomy
 *
 * @param $taxonomy
 *
 * @return string
 */
function get_order_name($taxonomy)
{
    switch ($taxonomy)
    {
        case DisciplineFetcher::TAXONOMY_DISCIPLINE:
            return ORDER_DISCIPLINE;

        case ArtworkTagFetcher::TAXONOMY_ARTWORK_TAG:
            return ORDER_ARTWORK_TAG;

        default:
            return ORDER_HOME;
    }
}

/**
 * Get stored ids in an order
 *
 * @param $order_name
 *
 * @return array
 */
function get_order_stored_ids($order_name)
{
    $wp_session = WP_Session::get_instance();

    return (isset($wp_session[$order_name]))
        ? $wp_session[$order_name]->toArray()
        : array();
}

/**
 * Store in session pods ids in given key
 *
 * @param array  $artworks
 * @param string $key
 * @param bool   $overwrite
 */
function store_pods_ids($artworks, $key, $overwrite = false)
{
    $wp_session = WP_Session::get_instance();

    // Create or get existing array
    $to_be_stored = ($overwrite) ? array() : $wp_session[$key]->toArray();

    // Add ids
    foreach ($artworks as $artwork)
    {
        $to_be_stored[] = $artwork->ID;
    }

    // Store
    $wp_session[$key] = $to_be_stored;
}


/**
 * Get disciplines
 *
 * @return array
 */
function get_disciplines()
{
    global $disciplineFetcher;

    return $disciplineFetcher->getAll();
}

/**
 * Get artwork tags
 *
 * @return array
 */
function get_artwork_tags()
{
    global $artworkTagFetcher;

    return $artworkTagFetcher->getAll();
}


/**
 * Get published artists
 *
 * @return array
 */
function get_published_artists()
{
    global $artistFetcher;

    return $artistFetcher->getPublished();
}


/**
 * Get published artists by primary discipline
 *
 * @return array
 */
function get_published_artists_by_primary_discipline()
{
    $artists = get_published_artists();
    $disciplines = array();

    foreach ($artists as $artist)
    {
        if ($artist->discipline_slug)
        {
            $slug = $artist->discipline_slug;
            if (!isset($disciplines[$slug]))
            {
                $disciplines[$slug] = array(
                    'name'    => $artist->discipline_name,
                    'slug'    => $slug,
                    'artists' => array()
                );
            }

            $disciplines[$slug]['artists'][] = $artist;
        }
    }

    return $disciplines;
}

/**
 * Find artist by id
 *
 * @param int $artist_id
 *
 * @return bool|\Pods
 */
function find_artist($artist_id)
{

    return pods(ArtistFetcher::POST_TYPE_ARTIST, $artist_id);
}

/**
 * Get disciplines by artist
 *
 * @param int $artist_id
 *
 * @return bool|\Pods
 */
function get_artist_disciplines($artist_id)
{
    global $disciplineFetcher;

    return $disciplineFetcher->getByArtist($artist_id);
}