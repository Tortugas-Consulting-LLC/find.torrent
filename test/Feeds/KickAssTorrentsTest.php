<?php

namespace Tests\Feeds;

use \FindDotTorrent\Feeds\KickAssTorrents;

class KickAssTorrentsTest extends \PHPUnit_Framework_TestCase
{
    protected $feed;

    public function setUp()
    {
        $this->feed = new KickAssTorrents();
    }

    public function urlProvider()
    {
        return array(
            array('12 Angry Men', 'http://kat.ph/usearch/12+Angry+Men/?rss=1'),
            array('Law & Order', 'http://kat.ph/usearch/Law+%26+Order/?rss=1'),
            array("Gideon's Trumpet", 'http://kat.ph/usearch/Gideon%27s+Trumpet/?rss=1')
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
        $xml = file_get_contents('Fixtures/KickAssTorrents/12-angry-men.xml');

        $results = $this->feed->fetchResults($xml);
        $this->assertNotEmpty($results);
        $this->assertCount(25, $results);
    }
}
