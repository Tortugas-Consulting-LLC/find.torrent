<?php

namespace FindDotTorrent\Feeds;

abstract class BaseFeed implements IFeed
{
    protected $enabled;

    public function getIdentifier()
    {
        return str_replace(' ', '', strtolower($this->getName()));
    }

    public function getName()
    {
        return preg_replace('/([a-z])([A-Z])/', '\1 \2', current(array_slice(explode('\\', get_class($this)), -1)));
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    abstract public function getUrl();
    abstract public function makeSearchUrl($term);
    abstract public function fetchResults($response);
}
