<?php

class MininovaTest extends \PHPUnit_Framework_TestCase
{
    protected $translator;

    public function setUp()
    {
        $this->translator = new \FindDotTorrent\Translator\Rss();
    }

    public function getMockClient($url, $content)
    {
        $client = $this->getMock('\FindDotTorrent\Client');
        $client->expects($this->once())
               ->method('get')
               ->with($url)
               ->will($this->returnValue($content));

        return $client;
    }

    public function testWillSearchCorrectly()
    {
        $content = file_get_contents(__DIR__ . '/../Fixtures/Mininova/12-angry-men.xml');
        $client = $this->getMockClient(
            'http://mininova.org/rss/12%20angry%20men',
            $content
        );

        $feed = new \FindDotTorrent\Feed\Mininova(
            $client,
            $this->translator
        );
        $items = $feed->search('12 angry men');

        $this->assertInternalType('array', $items);
        $this->assertCount(2, $items);

        $this->assertEquals('Dave - King of the trowsers - 128kbps plus covers - ANGRY GENTLEMEN RECORDS', $items[0]->getTitle());
        $this->assertEquals('http://www.mininova.org/get/2461403', $items[0]->getLink());
        $this->assertEquals('Mininova', $items[0]->getLabel());

        $this->assertEquals("VIRGIN SHITHOUSE - 'Baggy Trowsers' and 'Peach' plus covers - 128kbps - ANGRY GENTLEMEN RECORDS", $items[1]->getTitle());
        $this->assertEquals('http://www.mininova.org/get/2357085', $items[1]->getLink());
        $this->assertEquals('Mininova', $items[1]->getLabel());
    }
}