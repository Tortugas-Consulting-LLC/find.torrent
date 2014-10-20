<?php

namespace FindDotTorrent\Domain\Translator;

use FindDotTorrent\Domain;

/**
 * Rss Translator
 *
 * The rss translator should be able to take raw rss content and return an
 * array of Item objects
 */
class Rss implements Domain\Translator
{
    /**
     * Translate the raw content into an array of Item objects
     *
     * @param string $content
     * @return array
     */
    public function translate($content)
    {
        $dom = new \DOMDocument();
        $dom->loadXML($content);

        $xmlPath = new \DOMXPath($dom);
        $itemPath = $xmlPath->query('*/item');

        $items = array();

        foreach ($itemPath as $item) {
            $title = $item->getElementsByTagName('title')->item(0)->nodeValue;
            $url = $item->getElementsByTagName('enclosure')->item(0)->getAttribute('url');

            $items[] = new \FindDotTorrent\Domain\Item(trim($title), $url);
        }

        return $items;
    }
}