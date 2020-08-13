<?php

namespace Tests\Feature;

use App\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnerTest extends TestCase
{
    use RefreshDatabase;

    public function testOwnerDisplaysFirstName()
    {
        factory(Owner::class)->make()->save();

        $response = $this->get('/owners');

        $full_name = Owner::first()->fullName();
        $response->assertSeeText($full_name);
    }

    public function testOwnersDisplaysAddress()
    {
        factory(Owner::class)->make()->save();

        $response = $this->get('/owners');

        $address = Owner::first()->fullAddress();
        $response->assertSeeText($address);
    }
}
