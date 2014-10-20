<?php

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsCorrectFeed()
    {
        $client = new \FindDotTorrent\Infrastructure\GuzzleClient();
        $factory = new \FindDotTorrent\Domain\Feed\Factory($client);

        $kickass = $factory->build(array('label' => 'KickAss', 'enabled' => true));

        $this->assertInstanceOf('\FindDotTorrent\Domain\Feed', $kickass);
        $this->assertInstanceOf('\FindDotTorrent\Domain\Feed\KickAss', $kickass);

        $mininova = $factory->build(array('label' => 'Mininova', 'enabled' => true));

        $this->assertInstanceOf('\FindDotTorrent\Domain\Feed', $mininova);
        $this->assertInstanceOf('\FindDotTorrent\Domain\Feed\Mininova', $mininova);

        try {
            $factory->build(array('label' => 'non-existent-feed', 'enabled' => true));
            $this->fail('Non-existent feeds should throw an InvalidArgumentException');
        } catch (\InvalidArgumentException $e) {
            // pass
        }

    }
}
