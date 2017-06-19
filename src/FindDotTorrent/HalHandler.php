<?php

namespace FindDotTorrent;

use NoCarrier\Hal;

/**
 * Class Halhandler
 * @package FindDotTorrent
 */
class Halhandler
{
    /**
     * @var \Bullet\App
     */
    protected $app;

    /**
     * Halhandler constructor.
     * @param \Bullet\App $app
     */
    public function __construct(\Bullet\App $app)
    {
        $this->app = $app;
    }

    /**
     * @param Hal $hal
     */
    public function addMyCurie(Hal $hal)
    {
        $hal->addCurie("ft", $this->app['base_uri'] . '/rels/{rels}');
    }
}
