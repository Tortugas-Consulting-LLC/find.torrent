<?php

namespace FindDotTorrent\Domain;

/**
 * Each feed should take a search term and return an array of Item objects
 * found at its site.
 */
interface Feed
{
    /**
     * Perform a search for a specific term
     *
     * @param string $term The search term
     * @return array An array of Item objects
     */
    public function search($term);

    /**
     * Each feed should have a unique label which represents itself
     *
     * @return string
     */
    public function getLabel();

    /**
     * Return an array to be used when serializing / encoding this object as JSON
     *
     * @return array
     */
    public function jsonSerialize();
}