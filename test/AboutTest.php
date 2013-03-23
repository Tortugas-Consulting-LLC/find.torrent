<?php

namespace Tests;

class AboutTest extends BulletTestCase
{
    protected $json;

    public function setup()
    {
        $request = new \Bullet\Request('GET', '/about/');
        $response = $this->getApp()->run($request);
        $this->json = json_decode($response->content());
    }

    public function linksProvider()
    {
        return array(
            array('self', '/about/'),
            array('home', '/'),
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

    public function testServiceName()
    {
        $this->assertTrue(isset($this->json->service));
        $this->assertEquals('find.torrent', $this->json->service);
    }

    public function testAboutMessageIsPresent()
    {
        $this->assertTrue(isset($this->json->about));
    }

    public function testVersionNumber()
    {
        $this->assertTrue(isset($this->json->version));
    }
}

