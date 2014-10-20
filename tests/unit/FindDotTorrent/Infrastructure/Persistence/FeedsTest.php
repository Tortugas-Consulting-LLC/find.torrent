<?php

namespace FindDotTorrent\Infrastructure\Persistence;

use FindDotTorrent\Domain;
use FindDotTorrent\Infrastructure;

class FeedsTest extends \PHPUnit_Framework_TestCase
{
    protected $factory;
    protected $db;

    public function setUp()
    {
        $client = new Infrastructure\GuzzleClient();
        $this->factory = new Domain\Feed\Factory($client);
        $this->db = $this->getMockBuilder('\Doctrine\DBAL\Connection')
                         ->disableOriginalConstructor()
                         ->getMock();
    }

    public function testCanGetEnabledFeeds()
    {
        $results = array(
            array('label' => 'KickAss', 'enabled' => true),
            array('label' => 'Mininova', 'enabled' => true),
        );

        $this->db->expects($this->once())
           ->method('fetchAll')
           ->will($this->returnValue($results));

        $repo = new Infrastructure\Persistence\PdoFeedRepository($this->db, $this->factory);
        $feeds = $repo->getEnabled();

        $this->assertCount(2, $feeds);
        $this->assertInstanceOf('\FindDotTorrent\Domain\Feed\KickAss', $feeds[0]);
        $this->assertInstanceOf('\FindDotTorrent\Domain\Feed\Mininova', $feeds[1]);
    }

    public function testCanGetIndividualFeed()
    {
        $this->db->expects($this->once())
                 ->method('fetchAssoc')
                 ->will($this->returnValue(array('label' => 'KickAss', 'enabled' => true)));

        $repo = new Infrastructure\Persistence\PdoFeedRepository($this->db, $this->factory);
        $feed = $repo->get('KickAss');

        $this->assertInstanceOf('\FindDotTorrent\Domain\Feed\KickAss', $feed);
    }

    public function testReturnsFalseForNoMatch()
    {
        $this->db->expects($this->once())
           ->method('fetchAssoc')
           ->will($this->returnValue(array()));

        $repo = new Infrastructure\Persistence\PdoFeedRepository($this->db, $this->factory);
        $feed = $repo->get('KickAss');

        $this->assertFalse($feed);
    }

    public function testCanGetAll()
    {
        $results = array(
            array('label' => 'KickAss', 'enabled' => true),
            array('label' => 'Mininova', 'enabled' => true),
        );

        $this->db->expects($this->once())
           ->method('fetchAll')
           ->will($this->returnValue($results));

        $repo = new Infrastructure\Persistence\PdoFeedRepository($this->db, $this->factory);
        $feeds = $repo->all();

        $this->assertCount(2, $feeds);
        $this->assertInstanceOf('\FindDotTorrent\Domain\Feed\KickAss', $feeds[0]);
        $this->assertInstanceOf('\FindDotTorrent\Domain\Feed\Mininova', $feeds[1]);
    }

    public function testCanSetStatus()
    {
        $feed = $this->getMock('\FindDotTorrent\Domain\Feed');
        $feed->expects($this->once())
             ->method('getLabel')
             ->will($this->returnValue('KickAss'));

        $this->db->expects($this->once())
           ->method('update')
           ->with(
               'feeds',
               array('enabled' => true),
               array('label' => 'KickAss')
           );

        $repo = new Infrastructure\Persistence\PdoFeedRepository($this->db, $this->factory);
        $repo->setStatus($feed, true);
    }
}
