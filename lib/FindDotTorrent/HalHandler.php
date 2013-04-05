<?php

namespace FindDotTorrent;

class Halhandler
{
    /**
     * @var \Bullet\App
     */
    protected $app;

    public function __construct(\Bullet\App $app)
    {
        $this->app = $app;
    }

    public function addMyCurie(\NoCarrier\Hal $hal) {
        $hal->addCurie("ft", $this->app['base_uri'] . '/rels/{rels}');
    }
}
