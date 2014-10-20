<?php

namespace FindDotTorrent\Domain\Translator;

use FindDotTorrent\Domain;

class RssTest extends \PHPUnit_Framework_TestCase
{
    public function testHandlesMininovaAppropriately()
    {
        $content = file_get_contents(__DIR__ . '/../../Fixtures/Mininova/12-angry-men.xml');

        $translator = new Domain\Translator\Rss();
        $items = $translator->translate($content);

        $this->assertInternalType('array', $items);
        $this->assertCount(2, $items);

        $this->assertEquals('Dave - King of the trowsers - 128kbps plus covers - ANGRY GENTLEMEN RECORDS', $items[0]->getTitle());
        $this->assertEquals('http://www.mininova.org/get/2461403', $items[0]->getLink());

        $this->assertEquals("VIRGIN SHITHOUSE - 'Baggy Trowsers' and 'Peach' plus covers - 128kbps - ANGRY GENTLEMEN RECORDS", $items[1]->getTitle());
        $this->assertEquals('http://www.mininova.org/get/2357085', $items[1]->getLink());
    }

    public function testHandlesKickAssAppropriately()
    {
        $content = file_get_contents(__DIR__ . '/../../Fixtures/Kickass/12-angry-men.xml');

        $translator = new Domain\Translator\Rss();
        $items = $translator->translate($content);

        $this->assertInternalType('array', $items);
        $this->assertCount(25, $items);

        $this->assertEquals('12 Angry Men 1957 720p BluRay x264 mkv', $items[0]->getTitle());
        $this->assertEquals('http://torcache.net/torrent/3375B06C9127B5ED122B6E2B347C5447F4CE0343.torrent?title=[kat.ph]12.angry.men.1957.720p.bluray.x264.mkv', $items[0]->getLink());

        $this->assertEquals('12 Angry Men (1957) [MICROHD 1080p] [DUAL]', $items[1]->getTitle());
        $this->assertEquals('http://torcache.net/torrent/EB2BFFFD416B2C9FEBF1A7FF371EBC2AE98D6B94.torrent?title=[kat.ph]12.angry.men.1957.microhd.1080p.dual', $items[1]->getLink());
    }
}