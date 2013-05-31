<?php

namespace Tests\Feeds;

use \Tests\BulletTestCase;
use \FindDotTorrent\FeedHandler;

class FeedHandlertest extends BulletTestCase
{
    protected $handler;

    public function setup()
    {
        parent::setup();

        $this->handler = $this->getApp()->getFeedHandler();
    }

    public function testFeedHandlerFindAllReturnsMeOnlyFeedObjects()
    {
        $feeds = $this->handler->findAll();
        $this->assertInternalType('array', $feeds);
        $this->assertContainsOnlyInstancesOf('\FindDotTorrent\Feeds\BaseFeed', $feeds);
    }

    public function testICanGetASpecificTypeOfFeedFromTheFeedHandler()
    {
        $this->assertInstanceOf('\FindDotTorrent\Feeds\KickAssTorrents', $this->handler->findBy('kickasstorrents'));
    }

    public function testExpectedFailureWhenIAskTheFeedHandlerForABogusFeed()
    {
        $this->assertFalse($this->handler->findBy('foobartorrents'));
    }
}
