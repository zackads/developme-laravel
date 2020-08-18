<?php

namespace Tests\Feature;

use App\Owner;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnersTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class)->create()->save();
    }

    public function testOwnersShowsNoRecords()
    {
        $response = $this->actingAs(User::first())->get('/owners');
        $response->assertSeeText("There are no owners sad_face.jpg");
    }

    public function testOwnersDisplaysFirstName()
    {
        factory(Owner::class)->make()->save();

        $response = $this->actingAs(User::first())->get('/owners');

        $full_name = Owner::first()->fullName();
        $response->assertSeeText($full_name);
    }

    public function testOwnersDisplaysAddress()
    {
        factory(Owner::class)->make()->save();

        $response = $this->actingAs(User::first())->get('/owners');

        $address = Owner::first()->fullAddress();
        $response->assertSeeText($address);
    }
}
