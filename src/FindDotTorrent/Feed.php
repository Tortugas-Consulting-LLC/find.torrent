<?php

namespace FindDotTorrent;

/**
 * Each feed should take a search term and return an array of Item objects
 * found at its site.
 */
interface Feed
{
    /**
     * @param string $term The term to search for
     * @return array An array of Item objects
     */
    public function search($term);

    /**
     * Each feed should have a unique label which represents itself
     *
     * @return string
     */
    public function getLabel();
}