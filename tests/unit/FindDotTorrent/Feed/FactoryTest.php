<?php

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsCorrectFeed()
    {
        $client = new \FindDotTorrent\Client\GuzzleAdapter();
        $factory = new \FindDotTorrent\Feed\Factory($client);

        $kickass = $factory->build(array('label' => 'KickAss', 'enabled' => true));

        $this->assertInstanceOf('\FindDotTorrent\Feed', $kickass);
        $this->assertInstanceOf('\FindDotTorrent\Feed\KickAss', $kickass);

        $mininova = $factory->build(array('label' => 'Mininova', 'enabled' => true));

        $this->assertInstanceOf('\FindDotTorrent\Feed', $mininova);
        $this->assertInstanceOf('\FindDotTorrent\Feed\Mininova', $mininova);

        try {
            $factory->build(array('label' => 'non-existent-feed', 'enabled' => true));
            $this->fail('Non-existent feeds should throw an InvalidArgumentException');
        } catch (\InvalidArgumentException $e) {
            // pass
        }

    }
}