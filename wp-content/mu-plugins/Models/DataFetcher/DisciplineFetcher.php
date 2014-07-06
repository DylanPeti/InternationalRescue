<?php

namespace Models\DataFetcher;

/**
 * Fetch disciplines from the database
 *
 * Class DisciplineFetcher
 * @package Models\DataFetcher
 *
 * @author Alix Chaysinh <alix@gladeye.co.nz>
 * @since  6/03/14
 */
class DisciplineFetcher
{
    const TAXONOMY_DISCIPLINE = 'discipline';

    /**
     * Return all disciplines
     *
     * @return array
     */
    public function getAll()
    {
        global $wpdb;

        $query = "SELECT t.*"
            ." FROM $wpdb->terms AS t"
            ." INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id AND tt.taxonomy = '".self::TAXONOMY_DISCIPLINE."'"
            ." ORDER BY t.name";

        return $wpdb->get_results($query);
    }

    /**
     * Return an artist's disciplines
     *
     * @param int $artist_id
     *
     * @return array
     */
    public function getByArtist($artist_id)
    {
        // Query
        $artworks = pods(ArtworkFetcher::POST_TYPE_ARTWORK, array(
            'where' => ArtworkFetcher::FIELD_ARTIST.'.ID = '.$artist_id
        ));

        // Store in array
        $disciplines = array();
        while ($artworks->fetch())
        {
            $artwork_discipline = $artworks->field(ArtworkFetcher::FIELD_DISCIPLINE);
            if (!array_key_exists($artwork_discipline['slug'], $disciplines))
            {
                $disciplines[$artwork_discipline['slug']] = array(
                    'id'   => $artwork_discipline['term_id'],
                    'name' => $artwork_discipline['name']
                );
            }
        }

        return $disciplines;
    }
} 