<?php

namespace Tests\Unit;

use App\Owner;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    public function testRoot()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testInvalidSubdirectory()
    {
        $response = $this->get('/doesntexist');
        $response->assertStatus(404);
    }

    public function testAuthenticationRequiredOnOwners()
    {
        $response = $this->get('/owners');
        $response->assertStatus(302);
    }

    public function testOwners()
    {
        factory(User::class)->create()->save();

        $response = $this->actingAs(User::first())->get('/owners');
        $response->assertStatus(200);
    }

    public function testOwnerShowReturns200ForValidId()
    {
        factory(Owner::class)->make()->save();
        factory(User::class)->create()->save();

        $first_owner = Owner::first()->id;
        $response = $this->actingAs(User::first())->get("/owners/{$first_owner}");

        $response->assertStatus(200);
    }

    public function testOwnerShowReturns404ForInvalidId()
    {
        factory(User::class)->create()->save();

        $invalid_owner_id = Owner::count() + 1;
        $response = $this->actingAs(User::first())->get("/owners/{$invalid_owner_id}");

        $response->assertStatus(404);
    }
}
