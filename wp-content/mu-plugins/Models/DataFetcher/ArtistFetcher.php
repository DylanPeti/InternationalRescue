<?php

namespace Models\DataFetcher;

/**
 * Fetch artists from the database
 *
 * Class ArtistFetcher
 * @package Models\DataFetcher
 *
 * @author Alix Chaysinh <alix@gladeye.co.nz>
 * @since  6/03/14
 */
class ArtistFetcher
{
    const POST_TYPE_ARTIST    = 'artist';
    const POST_STATUS_PUBLISH = 'publish';

    const FIELD_PRIMARY_DISCIPLINE = 'primary_discipline';

    /**
     * Return all artists
     *
     * @return array
     */
    public function getPublished()
    {
        global $wpdb;

        $query = "SELECT p.*"
            .', `'.self::FIELD_PRIMARY_DISCIPLINE.'`.term_id as discipline_id, `'.self::FIELD_PRIMARY_DISCIPLINE.'`.name as discipline_name, `'.self::FIELD_PRIMARY_DISCIPLINE.'`.slug as discipline_slug'
            ." FROM $wpdb->posts AS p"
            ." LEFT JOIN `wp_podsrel` AS `podsrel_discipline`
                ON (p.ID = podsrel_discipline.item_id)
                AND (podsrel_discipline.pod_id = (SELECT ID FROM `wp_posts` WHERE post_name = '".self::POST_TYPE_ARTIST."'AND post_type = '_pods_pod'))
                AND (podsrel_discipline.field_id = (SELECT ID FROM `wp_posts` WHERE post_name = '".self::FIELD_PRIMARY_DISCIPLINE."'))"

            .' LEFT JOIN `wp_terms` AS `'.self::FIELD_PRIMARY_DISCIPLINE.'`
                ON `'.self::FIELD_PRIMARY_DISCIPLINE.'`.term_id = `podsrel_discipline`.related_item_id'
            ." WHERE post_type = '".self::POST_TYPE_ARTIST."'"
            ." AND post_status = '".self::POST_STATUS_PUBLISH."'"
            ." ORDER BY p.post_title";

        return $wpdb->get_results($query);
    }
} 