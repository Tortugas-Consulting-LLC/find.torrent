<?php

namespace Tests\Models;

class BaseFeedTest extends \Tests\BulletTestCase
{
    protected $feed;

    public function setup()
    {
        $this->feed = $this->getMock('\FindDotTorrent\Feeds\BaseFeed', array('makeSearchUrl', 'fetchResults', 'getUrl'));
    }

    public function testFeedName()
    {
        $this->assertEquals('Mock_Base Feed', substr($this->feed->getName(), 0, 14));
    }

    public function testFeedIdentifier()
    {
        $this->assertEquals('mock_basefeed', substr($this->feed->getIdentifier(), 0, 13));
    }

    // TODO test feed enable/disabled
}
