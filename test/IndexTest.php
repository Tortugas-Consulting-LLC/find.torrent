<?php

namespace Tests;

class IndexTest extends BulletTestCase
{
    public function testRootNavigation()
    {
        $request = new \Bullet\Request('GET', '/');
        $response = $this->getApp()->run($request);

        $json = json_decode($response->content());

        $this->assertTrue(isset($json->_links));

        $this->assertTrue(isset($json->_links->self));
        $this->assertTrue(isset($json->_links->self->href));
        $this->assertEquals('/', $json->_links->self->href);

        $this->assertTrue(isset($json->_links->about));
        $this->assertTrue(isset($json->_links->about->href));
        $this->assertEquals('/about/', $json->_links->about->href);

        $this->assertTrue(isset($json->_links->feeds));
        $this->assertTrue(isset($json->_links->feeds->href));
        $this->assertEquals('/feeds/', $json->_links->feeds->href);

        $this->assertTrue(isset($json->_links->search));
        $this->assertTrue(isset($json->_links->search->href));
        $this->assertEquals('/feed/search/{?term}', $json->_links->search->href);
        $this->assertTrue(isset($json->_links->search->templated));
        $this->assertEquals(true, $json->_links->search->templated);

        $this->assertTrue(isset($json->_links->history));
        $this->assertTrue(isset($json->_links->history->href));
        $this->assertEquals('/feeds/history/', $json->_links->history->href);

        $this->assertTrue(isset($json->welcome));
        $this->assertEquals($this->getApp()->offsetGet('welcome_msg'), $json->welcome);
    }
}

