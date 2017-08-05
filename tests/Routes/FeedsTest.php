<?php

namespace Tests\Routes;

use Bullet\Request;
use Tests\BulletTestCase;

class FeedsTest extends BulletTestCase
{
    protected $json;

    public function setup()
    {
        $request = new Request('GET', '/feeds/');
        $response = $this->getApp()->run($request);
        $this->json = json_decode($response->content());
    }

    public function testCurieIsPresent()
    {
        $this->assertTrue(isset($this->json->_links->curies));
    }

    public function linksProvider()
    {
        return array(
            array('self', '/feeds/'),
            array('ft:home', '/'),
            array('ft:search', '/search/{?term}')
        );
    }

    /**
     * @dataProvider linksProvider
     */
    public function testNavigationLinks($link, $href)
    {
        $this->assertTrue(isset($this->json->_links->{$link}->href));
        $this->assertEquals($href, $this->json->_links->{$link}->href);
    }

    public function testSearchNavigationLinkIsTemplated()
    {
        $this->assertTrue($this->json->_links->{"ft:search"}->templated);
    }

    public function testFeedsAreEmbedded()
    {
        $this->assertTrue(isset($this->json->_embedded->{"ft:feed"}));
    }
}

