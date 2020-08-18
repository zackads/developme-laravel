<?php

namespace Tests\Feature;

use App\Owner;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class)->create()->save();
        factory(Owner::class)->make()->save();
    }

    public function testOwnerDisplaysFirstName()
    {

        $response = $this->actingAs(User::first())->get('/owners');

        $full_name = Owner::first()->fullName();
        $response->assertSeeText($full_name);
    }

    public function testOwnersDisplaysAddress()
    {
        $response = $this->actingAs(User::first())->get('/owners');

        $address = Owner::first()->fullAddress();
        $response->assertSeeText($address);
    }
}
