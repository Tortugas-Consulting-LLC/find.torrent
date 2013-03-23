<?php

namespace Tests;

class IndexTest extends BulletTestCase
{
    public function testRootNavigation()
    {
        $request = new \Bullet\Request('GET', '/');
        $response = $this->getApp()->run($request);

        $this->assertEquals('Hello, world!', $response->content());
    }
}

