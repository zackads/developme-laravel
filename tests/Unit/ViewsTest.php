<?php

namespace Tests\Unit;

use App\Owner;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class)->create()->save();
    }

    public function testRootViewIsWelcome()
    {
        $response = $this->actingAs(User::first())->get('/');
        $response->assertViewIs('welcome');
    }

    public function testOwnersViewIsOwners()
    {
        $response = $this->actingAs(User::first())->get('/owners');
        $response->assertViewIs('owners');
    }

    public function testOwnerShowViewisOwner()
    {
        factory(Owner::class)->make()->save();
        $first_owner = Owner::first()->id;

        $response = $this->actingAs(User::first())->get("/owners/{$first_owner}");
        $response->assertViewIs("owner");
    }

}
