<?php

namespace Tests;

use FindDotTorrent\App;
use PHPUnit\Framework\TestCase;

class BulletTestCase extends TestCase
{
    private $app = null;

    protected function getApp()
    {
        if (null === $this->app) {
            $this->app = new App();
        }

        return $this->app;
    }
}

