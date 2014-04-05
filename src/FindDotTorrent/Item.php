<?php

namespace FindDotTorrent;

class Item
{
    protected $title;
    protected $link;
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

    public function getTitle()
    {
        return $this->title;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }
}