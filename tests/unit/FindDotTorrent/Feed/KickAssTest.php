<?php

class KickAssTest extends \PHPUnit_Framework_TestCase
{
    protected $translator;

    public function setUp()
    {
        $this->translator = new \FindDotTorrent\Domain\Translator\Rss();
    }

    public function getMockClient($url, $content)
    {
        $client = $this->getMock('\FindDotTorrent\Domain\Client');
        $client->expects($this->once())
               ->method('get')
               ->with($url)
               ->will($this->returnValue($content));

        return $client;
    }

    public function testSerializesCorrectly()
    {
        $feed = new \FindDotTorrent\Domain\Feed\KickAss(
            new FindDotTorrent\Infrastructure\GuzzleClient(),
            $this->translator,
            false
        );

        $expected = json_encode(
            array(
                'label' => 'KickAss',
                'enabled' => false
            )
        );

        $this->assertJsonStringEqualsJsonString($expected, json_encode($feed));
    }

    public function testWillSearchCorrectly()
    {
        $content = file_get_contents(__DIR__ . '/../Fixtures/Kickass/12-angry-men.xml');
        $client = $this->getMockClient(
            'http://kickass.to/usearch/12%20angry%20men/?rss=1',
            $content
        );

        $feed = new \FindDotTorrent\Domain\Feed\KickAss(
            $client,
            $this->translator,
            true
        );
        $items = $feed->search('12 angry men');

        $this->assertInternalType('array', $items);
        $this->assertCount(25, $items);

        $this->assertEquals('12 Angry Men 1957 720p BluRay x264 mkv', $items[0]->getTitle());
        $this->assertEquals('http://torcache.net/torrent/3375B06C9127B5ED122B6E2B347C5447F4CE0343.torrent?title=[kat.ph]12.angry.men.1957.720p.bluray.x264.mkv', $items[0]->getLink());
        $this->assertEquals('KickAss', $items[0]->getLabel());

        $this->assertEquals('12 Angry Men (1957) [MICROHD 1080p] [DUAL]', $items[1]->getTitle());
        $this->assertEquals('http://torcache.net/torrent/EB2BFFFD416B2C9FEBF1A7FF371EBC2AE98D6B94.torrent?title=[kat.ph]12.angry.men.1957.microhd.1080p.dual', $items[1]->getLink());
        $this->assertEquals('KickAss', $items[1]->getLabel());
    }
}
