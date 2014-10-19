<?php

namespace FindDotTorrent\Domain;

/**
 * An item represents a search result from a particular feed.
 */
class Item implements \JsonSerializable
{
    /**
     * @var string The title of the torrent
     */
    protected $title;

    /**
     * @var string The URL where the torrent file can be downloaded
     */
    protected $link;

    /**
     * @var string A label indicating the source of the feed
     */
    protected $label = 'Unknown';

    /**
     * @param string $title The title of the torrent file
     * @param string $link The URL from which the torrent can be downloaded
     */
    public function __construct($title, $link)
    {
        $this->title = $title;
        $this->link = $link;
    }

    /**
     * Retrieve the title of this torrent
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Retrieve the link where this torrent can be downloaded
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Specify a label to indicate where this result came from
     *
     * @param string $label
     * @return Item
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Retrieve the label indicating where this result came from
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Return an array to be used when serializing / encoding this object as JSON
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array(
            'title' => $this->title,
            'link' => $this->link,
            'label' => $this->label
        );
    }
}