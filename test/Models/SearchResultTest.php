<?php

namespace Tests\Models;

use \FindDotTorrent\Feeds\SearchResult;

class SearchResultTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicDetails()
    {
        $result = new SearchResult();
        $result->setTitle('12 Angry Men')
               ->setId('1234567890')
               ->setLink('http://www.mininova.org/tor/9876543210');

        $this->assertEquals('12 Angry Men', $result->getTitle());
        $this->assertEquals('1234567890', $result->getId());
        $this->assertEquals('http://www.mininova.org/tor/9876543210', $result->getLink());
    }
}
