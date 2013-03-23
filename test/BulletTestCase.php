<?php

namespace Tests;

class BulletTestCase extends \PHPUnit_Framework_TestCase
{
    private $app = null;

    protected function getApp()
    {
        if(null === $this->app) {
            require __DIR__ . '/../app.php';
            $this->app = $app;
        }

        return $this->app;
    }
}

