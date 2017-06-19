<?php

namespace Tests\Feeds;

use FindDotTorrent\FeedHandler;
use Tests\BulletTestCase;

class FeedHandlertest extends BulletTestCase
{
    /**
     * @var FeedHandler
     */
    protected $handler;

    public function setup()
    {
        parent::setup();

        $app = $this->getApp();
        $this->handler = $app['FeedHandler'];
    }

    public function testFeedHandlerFindAllReturnsMeOnlyFeedObjects()
    {
        $feeds = $this->handler->findAll();
        $this->assertInternalType('array', $feeds);
        $this->assertContainsOnlyInstancesOf('\FindDotTorrent\Feeds\BaseFeed', $feeds);
    }

    public function testICanGetASpecificTypeOfFeedFromTheFeedHandler()
    {
        $this->assertInstanceOf('\FindDotTorrent\Feeds\KickAssTorrents', $this->handler->find('kickasstorrents'));
    }

    public function testExpectedFailureWhenIAskTheFeedHandlerForABogusFeed()
    {
        $this->assertFalse($this->handler->find('foobartorrents'));
    }
}
