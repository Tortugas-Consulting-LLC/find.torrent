<?php

class SearchControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testCanSearchAll()
    {
        $kaFeed = $this->getMockFeed('Kick Ass', 'http://kickass.to', 'Kick Ass');
        $miniFeed = $this->getMockFeed('Mininova', 'http://mininova.org', 'Mininova');

        $factory = $this->getMock('\FindDotTorrent\Feed\Factory');
        $factory->expects($this->any())
                ->method('build')
                ->will($this->onConsecutiveCalls($kaFeed, $miniFeed));

        $controller = new \FindDotTorrent\Controller\SearchController($factory);

        $response = $controller->allAction('12 Angry Men');

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
    }

    protected function getMockFeed($title, $link, $label)
    {
        $item = new \FindDotTorrent\Item($title, $link);
        $item->setLabel($label);

        $feed = $this->getMock('\FindDotTorrent\Feed');
        $feed->expects($this->once())
               ->method('search')
               ->will($this->returnValue(array($item)));

        return $feed;
    }
}