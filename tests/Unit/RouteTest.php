<?php

namespace Tests\Unit;

use App\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

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

    public function testOwners()
    {
        $response = $this->get('/owners');
        $response->assertStatus(200);
    }

    public function testOwnerShow()
    {
        factory(Owner::class)->make()->save();
        $first_owner = Owner::first()->id;
        $response = $this->get("/owners/{$first_owner}");

        $response->assertStatus(200);
    }
}
