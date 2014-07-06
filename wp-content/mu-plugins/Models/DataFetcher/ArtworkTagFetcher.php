<?php

namespace Models\DataFetcher;

/**
 * Fetch artwork tags from the database
 *
 * Class ArtworkTagFetcher
 * @package Models\DataFetcher
 *
 * @author Alix Chaysinh <alix@gladeye.co.nz>
 * @since  6/03/14
 */
class ArtworkTagFetcher
{
    const TAXONOMY_ARTWORK_TAG = 'artwork_tag';

    /**
     * Return all artwork tags
     *
     * @return array
     */
    public function getAll()
    {
        global $wpdb;

        $query = "SELECT t.*"
            ." FROM $wpdb->terms AS t"
            ." INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id AND tt.taxonomy = '".self::TAXONOMY_ARTWORK_TAG."'"
            ." ORDER BY t.name";

        return $wpdb->get_results($query);
    }
} 