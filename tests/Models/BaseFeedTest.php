<?php

namespace Tests\Models;

use FindDotTorrent\Feeds\BaseFeed;
use Tests\BulletTestCase;

class BaseFeedTest extends BulletTestCase
{
    /**
     * @var BaseFeed
     */
    protected $feed;

    public function setup()
    {
        $this->feed = $this->getMockBuilder('\FindDotTorrent\Feeds\BaseFeed')
            ->setMethods(['makeSearchUrl', 'fetchResults', 'getUrl'])
            ->getMock();
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
