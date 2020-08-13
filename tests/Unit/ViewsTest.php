<?php

namespace Tests\Unit;

use App\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewsTest extends TestCase
{
    use RefreshDatabase;

    public function testRootViewIsWelcome()
    {
        $response = $this->get('/');
        $response->assertViewIs('welcome');
    }

    public function testOwnersViewIsOwners()
    {
        $response = $this->get('/owners');
        $response->assertViewIs('owners');
    }

    public function testOwnerShowViewisOwner()
    {
        factory(Owner::class)->make()->save();
        $first_owner = Owner::first()->id;

        $response = $this->get("/owners/{$first_owner}");
        $response->assertViewIs("owner");
    }

}
