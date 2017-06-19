<?php

namespace Tests\Feeds;

use FindDotTorrent\Feeds\Mininova;
use PHPUnit\Framework\TestCase;

class MininovaTest extends TestCase
{
    /**
     * @var Mininova
     */
    protected $feed;

    public function setUp()
    {
        $this->feed = new Mininova();
    }

    public function urlProvider()
    {
        return array(
            array('12 Angry Men', 'http://mininova.org/rss/12+Angry+Men'),
            array('Law & Order', 'http://mininova.org/rss/Law+%26+Order'),
            array("Gideon's Trumpet", 'http://mininova.org/rss/Gideon%27s+Trumpet')
        );
    }

    /**
     * @dataProvider urlProvider
     */
    public function testGenerateUrls($term, $encoded_url)
    {
        $this->assertEquals($encoded_url, $this->feed->makeSearchUrl($term));
    }

    public function testFetchResults()
    {
        $xml = file_get_contents(__DIR__ . '/../Fixtures/Mininova/12-angry-men.xml');

        $results = $this->feed->fetchResults($xml);
        $this->assertNotEmpty($results);
        $this->assertCount(2, $results);
    }

    public function testName()
    {
        $this->assertEquals('Mininova', $this->feed->getName());
    }

    public function testIdentifer()
    {
        $this->assertEquals('mininova', $this->feed->getIdentifier());
    }

    public function testUrl()
    {
        $this->assertEquals('http://mininova.org', $this->feed->getUrl());
    }
}
