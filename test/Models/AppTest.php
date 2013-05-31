<?php

namespace Tests\Models;

class AppTest extends \Tests\BulletTestCase
{
    public function testAppCanGiveMeAFeedHandler()
    {
        $this->assertInstanceOf('\FindDotTorrent\FeedHandler', $this->getApp()->getFeedHandler());
    }
}
