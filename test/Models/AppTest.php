<?php

namespace Tests\Models;

class AppTest extends \Tests\BulletTestCase
{
    public function testAppCanGiveMeAFeedHandler()
    {
        $app = $this->getApp();
        $this->assertInstanceOf('\FindDotTorrent\FeedHandler', $app['FeedHandler']);
    }
}
