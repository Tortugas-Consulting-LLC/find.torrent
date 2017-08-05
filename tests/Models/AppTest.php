<?php

namespace Tests\Models;

use Tests\BulletTestCase;

class AppTest extends BulletTestCase
{
    public function testAppCanGiveMeAFeedHandler()
    {
        $app = $this->getApp();
        $this->assertInstanceOf('\FindDotTorrent\FeedHandler', $app['FeedHandler']);
    }
}
