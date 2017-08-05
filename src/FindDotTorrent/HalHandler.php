<?php

namespace FindDotTorrent;

use NoCarrier\Hal;

/**
 * Class HalHandler
 * @package FindDotTorrent
 */
class HalHandler
{
    /**
     * @var \Bullet\App
     */
    protected $app;

    /**
     * HalHandler constructor.
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
