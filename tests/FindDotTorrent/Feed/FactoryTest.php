<?php

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsCorrectFeed()
    {
        $factory = new \FindDotTorrent\Feed\Factory();

        $kickass = $factory->build('KickAss');

        $this->assertInstanceOf('\FindDotTorrent\Feed\Feed', $kickass);
        $this->assertInstanceOf('\FindDotTorrent\Feed\KickAss', $kickass);

        $mininova = $factory->build('Mininova');

        $this->assertInstanceOf('\FindDotTorrent\Feed\Feed', $mininova);
        $this->assertInstanceOf('\FindDotTorrent\Feed\Mininova', $mininova);

        try {
            $factory->build('non-existent-feed');
            $this->fail('Non-existent feeds should throw an InvalidArgumentException');
        } catch (\InvalidArgumentException $e) {
            // pass
        }

    }
}