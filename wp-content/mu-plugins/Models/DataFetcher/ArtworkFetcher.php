<?php

namespace Models\DataFetcher;


/**
 * Fetch artwork from the database
 *
 * Class ArtworkFetcher
 * @package Models\DataFetcher
 *
 * @author Alix Chaysinh <alix@gladeye.co.nz>
 * @since  6/03/14
 */
class ArtworkFetcher
{
    const POST_TYPE_ARTWORK   = 'artwork';
    const POST_STATUS_PUBLISH = 'publish';

    const FIELD_DISCIPLINE  = 'artwork_discipline';
    const FIELD_ARTIST      = 'artwork_artist';
    const FIELD_MEDIA       = 'artwork_media';
    const FIELD_TAGS        = 'artwork_tags';

    const FIELD_FEATURED    = 'featured';
    const FIELD_POSITION    = 'position';
    const FIELD_VIMEO_ID    = 'vimeo_id';

    /**
     * Return matching array between taxonomy names and relation names for pods queries
     *
     * @return array
     */
    public function getTaxonomyMatching()
    {
        return array(
            DisciplineFetcher::TAXONOMY_DISCIPLINE  => self::FIELD_DISCIPLINE,
            ArtworkTagFetcher::TAXONOMY_ARTWORK_TAG => self::FIELD_TAGS,
        );
    }

    /**
     * Return random published artworks
     *
     * @param int   $limit
     * @param array $filters
     *
     * @return bool|\Pods
     */
    public function getRandomPublished($limit = 50, $filters = array())
    {

        return $this->getPublished($limit, $filters, "RAND()");
    }

    /**
     * Return random published artworks
     *
     * @param int   $limit
     * @param array $filters
     *
     * @return bool|\Pods
     */
    public function getOrderedPublished($limit = 50, $filters = array())
    {

        return $this->getPublished($limit, $filters, "CAST(".self::FIELD_POSITION.".meta_value as SIGNED) ASC");
    }

    /**
     * Return published artworks in a defined order
     *
     * @param array $ordered_ids_list
     * @param array $filters
     *
     * @return bool|\Pods
     */
    public function getStoredOrderPublished(array $ordered_ids_list, $filters)
    {

        return $this->getPublished(null, $filters, "FIND_IN_SET(ID, '".join(', ', $ordered_ids_list)."')");
    }

    /**
     * Return random published artworks
     *
     * @param int    $limit
     * @param array  $filters
     * @param string $orderby
     *
     * @return bool|\Pods
     */
    public function getPublished($limit = 50, $filters = array(), $orderby = null)
    {
        global $wpdb;

        // Mysql variables
        $wpdb->query('SELECT ID INTO @artwork_pod_id FROM `wp_posts` WHERE post_name = "'.self::POST_TYPE_ARTWORK.'";');
        $wpdb->query('SELECT ID INTO @artist_field_id FROM `wp_posts` WHERE post_name = "'.self::FIELD_ARTIST.'";');
        $wpdb->query('SELECT ID INTO @media_field_id FROM `wp_posts` WHERE post_name = "'.self::FIELD_MEDIA.'";');
        $wpdb->query('SELECT ID INTO @discipline_field_id FROM `wp_posts` WHERE post_name = "'.self::FIELD_DISCIPLINE.'";');
        $wpdb->query('SELECT ID INTO @tag_field_id FROM `wp_posts` WHERE post_name = "'.self::FIELD_TAGS.'";');

        $query = '

SELECT DISTINCT
`t`.*,
`'.self::FIELD_FEATURED.'`.meta_value as '.self::FIELD_FEATURED.',
`'.self::FIELD_POSITION.'`.meta_value as '.self::FIELD_POSITION.',
`'.self::FIELD_VIMEO_ID.'`.meta_value as '.self::FIELD_VIMEO_ID.',
`'.self::FIELD_ARTIST.'`.ID as artist_id, `'.self::FIELD_ARTIST.'`.post_title as artist_name, `'.self::FIELD_ARTIST.'`.post_name as artist_slug,
`'.self::FIELD_MEDIA.'`.ID as media_id, `'.self::FIELD_MEDIA.'`.post_title as media_name, `'.self::FIELD_MEDIA.'`.post_content as media_description, `'.self::FIELD_MEDIA.'`.guid as media_src,
`'.self::FIELD_DISCIPLINE.'`.term_id as discipline_id, `'.self::FIELD_DISCIPLINE.'`.name as discipline_name, `'.self::FIELD_DISCIPLINE.'`.slug as discipline_slug,
GROUP_CONCAT(`'.self::FIELD_TAGS.'`.term_id) as tags_id, GROUP_CONCAT(`'.self::FIELD_TAGS.'`.name) as tags_name, GROUP_CONCAT(`'.self::FIELD_TAGS.'`.slug) as tags_slug



FROM `wp_posts` AS `t`


LEFT JOIN `wp_podsrel` AS `podsrel_artist`
    ON (t.ID = podsrel_artist.item_id)
    AND (podsrel_artist.pod_id = @artwork_pod_id  )
    AND (podsrel_artist.field_id = @artist_field_id)

LEFT JOIN `wp_posts` AS `'.self::FIELD_ARTIST.'`
    ON `'.self::FIELD_ARTIST.'`.ID = `podsrel_artist`.related_item_id


LEFT JOIN `wp_podsrel` AS `podsrel_media`
    ON (t.ID = podsrel_media.item_id)
    AND (podsrel_media.pod_id = @artwork_pod_id)
    AND (podsrel_media.field_id = @media_field_id)

LEFT JOIN `wp_posts` AS `'.self::FIELD_MEDIA.'`
    ON `'.self::FIELD_MEDIA.'`.ID = `podsrel_media`.related_item_id


LEFT JOIN `wp_podsrel` AS `podsrel_discipline`
    ON (t.ID = podsrel_discipline.item_id)
    AND (podsrel_discipline.pod_id = @artwork_pod_id)
    AND (podsrel_discipline.field_id = @discipline_field_id)


LEFT JOIN `wp_terms` AS `'.self::FIELD_DISCIPLINE.'`
    ON `'.self::FIELD_DISCIPLINE.'`.term_id = `podsrel_discipline`.related_item_id


LEFT JOIN `wp_podsrel` AS `podsrel_tags`
    ON (t.ID = podsrel_tags.item_id)
    AND (podsrel_tags.pod_id = @artwork_pod_id)
    AND (podsrel_tags.field_id = @tag_field_id)


LEFT JOIN `wp_terms` AS `'.self::FIELD_TAGS.'`
    ON `'.self::FIELD_TAGS.'`.term_id = `podsrel_tags`.related_item_id


LEFT JOIN `wp_postmeta` AS `'.self::FIELD_FEATURED.'`
    ON `'.self::FIELD_FEATURED.'`.`meta_key` = "'.self::FIELD_FEATURED.'"
    AND `'.self::FIELD_FEATURED.'`.`post_id` = `t`.`ID`


LEFT JOIN `wp_postmeta` AS `'.self::FIELD_POSITION.'`
    ON `'.self::FIELD_POSITION.'`.`meta_key` = "'.self::FIELD_POSITION.'"
    AND `'.self::FIELD_POSITION.'`.`post_id` = `t`.`ID`


LEFT JOIN `wp_postmeta` AS `'.self::FIELD_VIMEO_ID.'`
    ON `'.self::FIELD_VIMEO_ID.'`.`meta_key` = "'.self::FIELD_VIMEO_ID.'"
    AND `'.self::FIELD_VIMEO_ID.'`.`post_id` = `t`.`ID`

';

        // Where
        $where_part = array_merge(array(
            '( `t`.`post_type` = "'.self::POST_TYPE_ARTWORK.'" )',
            '( `t`.`post_status` = "'.self::POST_STATUS_PUBLISH.'" )'
        ), $filters);

        $query .= 'WHERE ( '. join(' AND ', $where_part).' )';


        // Group by

        $query .= ' GROUP BY t.ID';


        // Order by
        $order_by_part = (null !== $orderby) ? array($orderby) : array();
        $order_by_part = array_merge($order_by_part, array(
            '`t`.`menu_order`',
            '`t`.`post_title`',
            '`t`.`post_date`'
        ));

        $query .= ' ORDER BY '. join(', ', $order_by_part);

        // Limit
        if (null !== $limit)
        {
            $query .= " LIMIT 0, $limit";
        }


        return $wpdb->get_results($query);
    }
} 