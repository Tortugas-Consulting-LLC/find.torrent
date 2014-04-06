<?php

class FeedsTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGetEnabledFeeds()
    {
        $results = array(
            array('label' => 'KickAss'),
            array('label' => 'Mininova'),
        );

        $db = $this->getMockBuilder('\Doctrine\DBAL\Connection')
                   ->disableOriginalConstructor()
                   ->getMock();
        $db->expects($this->once())
           ->method('fetchAll')
           ->will($this->returnValue($results));

        $factory = new \FindDotTorrent\Feed\Factory();

        $repo = new \FindDotTorrent\Repository\Feeds($db, $factory);
        $feeds = $repo->getEnabled();

        $this->assertCount(2, $feeds);
        $this->assertInstanceOf('\FindDotTorrent\Feed\KickAss', $feeds[0]);
        $this->assertInstanceOf('\FindDotTorrent\Feed\Mininova', $feeds[1]);
    }

    public function testCanGetIndividualFeed()
    {
        $db = $this->getMockBuilder('\Doctrine\DBAL\Connection')
                   ->disableOriginalConstructor()
                   ->getMock();
        $db->expects($this->once())
           ->method('fetchAssoc')
           ->will($this->returnValue(array('label' => 'KickAss')));

        $factory = new \FindDotTorrent\Feed\Factory();

        $repo = new \FindDotTorrent\Repository\Feeds($db, $factory);
        $feed = $repo->get('KickAss');

        $this->assertInstanceOf('\FindDotTorrent\Feed\KickAss', $feed);
    }

    public function testReturnsFalseForNoMatch()
    {
        $db = $this->getMockBuilder('\Doctrine\DBAL\Connection')
                   ->disableOriginalConstructor()
                   ->getMock();
        $db->expects($this->once())
           ->method('fetchAssoc')
           ->will($this->returnValue(array()));

        $factory = new \FindDotTorrent\Feed\Factory();

        $repo = new \FindDotTorrent\Repository\Feeds($db, $factory);
        $feed = $repo->get('KickAss');

        $this->assertFalse($feed);
    }
}