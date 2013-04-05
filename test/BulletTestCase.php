<?php

namespace Tests;

class BulletTestCase extends \PHPUnit_Framework_TestCase
{
    private $app = null;

    protected function getApp()
    {
        if(null === $this->app) {
            $this->app = new \FindDotTorrent\App();
        }

        return $this->app;
    }
}

