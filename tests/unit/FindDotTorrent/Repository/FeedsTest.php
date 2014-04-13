<?php

class FeedsTest extends \PHPUnit_Framework_TestCase
{
    protected $factory;
    protected $db;

    public function setUp()
    {
        $this->factory = new \FindDotTorrent\Feed\Factory();
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

        $repo = new \FindDotTorrent\Repository\Feeds($this->db, $this->factory);
        $feeds = $repo->getEnabled();

        $this->assertCount(2, $feeds);
        $this->assertInstanceOf('\FindDotTorrent\Feed\KickAss', $feeds[0]);
        $this->assertInstanceOf('\FindDotTorrent\Feed\Mininova', $feeds[1]);
    }

    public function testCanGetIndividualFeed()
    {
        $this->db->expects($this->once())
                 ->method('fetchAssoc')
                 ->will($this->returnValue(array('label' => 'KickAss', 'enabled' => true)));

        $repo = new \FindDotTorrent\Repository\Feeds($this->db, $this->factory);
        $feed = $repo->get('KickAss');

        $this->assertInstanceOf('\FindDotTorrent\Feed\KickAss', $feed);
    }

    public function testReturnsFalseForNoMatch()
    {
        $this->db->expects($this->once())
           ->method('fetchAssoc')
           ->will($this->returnValue(array()));

        $repo = new \FindDotTorrent\Repository\Feeds($this->db, $this->factory);
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

        $repo = new \FindDotTorrent\Repository\Feeds($this->db, $this->factory);
        $feeds = $repo->all();

        $this->assertCount(2, $feeds);
        $this->assertInstanceOf('\FindDotTorrent\Feed\KickAss', $feeds[0]);
        $this->assertInstanceOf('\FindDotTorrent\Feed\Mininova', $feeds[1]);
    }

    public function testCanSetStatus()
    {
        $feed = $this->getMock('\FindDotTorrent\Feed');
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

        $repo = new \FindDotTorrent\Repository\Feeds($this->db, $this->factory);
        $repo->setStatus($feed, true);
    }
}