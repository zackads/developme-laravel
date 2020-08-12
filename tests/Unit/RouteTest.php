<?php

namespace Tests\Unit;

use Tests\TestCase;

class RouteTest extends TestCase
{
    public function testRoot()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testRootViewIsWelcome()
    {
        $response = $this->get('/');
        $response->assertViewIs('welcome');
    }

    public function testInvalidSubdirectory()
    {
        $response = $this->get('/doesntexist');
        $response->assertStatus(404);
    }
}
