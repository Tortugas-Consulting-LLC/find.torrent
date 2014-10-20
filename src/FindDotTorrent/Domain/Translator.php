<?php

namespace FindDotTorrent\Domain;

/**
 * A translator is responsible for taking raw content and extracting the
 * necessary details to generate the appropriate torrent data.
 */
interface Translator
{
    /**
     * @param string $content
     * @return array An array of Item objects
     */
    public function translate($content);
}
