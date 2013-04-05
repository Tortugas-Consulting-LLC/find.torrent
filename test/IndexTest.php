<?php

namespace Tests;

class IndexTest extends BulletTestCase
{
    protected $json;

    public function setup()
    {
        $request = new \Bullet\Request('GET', '/');
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
            array('self',    '/'),
            array('ft:about',   '/about/'),
            array('ft:feeds',   '/feeds/'),
            array('ft:search',  '/feeds/search/{?term}'),
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

    public function testSearchIsMarkedAsTemplated()
    {
        $this->assertTrue(isset($this->json->_links->{'ft:search'}->templated));
        $this->assertEquals(true, $this->json->_links->{'ft:search'}->templated);
    }

    public function testWelcomeMessage()
    {
        $this->assertTrue(isset($this->json->welcome));
        $this->assertEquals($this->getApp()->offsetGet('welcome_msg'), $this->json->welcome);
    }
}

