<?php

namespace Tests\Feeds;

use \FindDotTorrent\Feeds\MiniNova;

class MiniNovaTest extends \PHPUnit_Framework_TestCase
{
    protected $feed;

    public function setUp()
    {
        $this->feed = new MiniNova();
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
        $this->assertEquals($encoded_url, $this->feed->getUrl($term));
    }

    public function testFetchResults()
    {
        $xml = file_get_contents('Fixtures/MiniNova/12-angry-men.xml');

        $results = $this->feed->fetchResults($xml);
        $this->assertNotEmpty($results);
        $this->assertCount(2, $results);
    }
}
