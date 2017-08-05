<?php

namespace Tests\Feeds;

use FindDotTorrent\Feeds\KickAssTorrents;
use PHPUnit\Framework\TestCase;

class KickAssTorrentsTest extends TestCase
{
    /**
     * @var KickAssTorrents
     */
    protected $feed;

    public function setUp()
    {
        $this->feed = new KickAssTorrents();
    }

    public function urlProvider()
    {
        return array(
            array('12 Angry Men', 'https://kickass.to/usearch/12%20Angry%20Men/?rss=1'),
            array('Law & Order', 'https://kickass.to/usearch/Law%20%26%20Order/?rss=1'),
            array("Gideon's Trumpet", 'https://kickass.to/usearch/Gideon%27s%20Trumpet/?rss=1')
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
        $xml = file_get_contents(__DIR__ . '/../Fixtures/KickAssTorrents/12-angry-men.xml');

        $results = $this->feed->fetchResults($xml);
        $this->assertNotEmpty($results);
        $this->assertCount(25, $results);
    }

    public function testName()
    {
        $this->assertEquals('Kick Ass Torrents', $this->feed->getName());
    }

    public function testIdentifer()
    {
        $this->assertEquals('kickasstorrents', $this->feed->getIdentifier());
    }

    public function testUrl()
    {
        $this->assertEquals('https://kat.ph', $this->feed->getUrl());
    }
}
