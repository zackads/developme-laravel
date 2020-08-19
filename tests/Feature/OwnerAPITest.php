<?php

namespace Tests\Feature;

use App\Owner;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class OwnerAPITest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        factory(Owner::class)->make()->save();
        factory(User::class)->make()->save();
    }

    public function testListAllOwners()
    {
        $response = $this->actingAs(User::first())->json('GET', '/api/owners', ['accept' => "application/json"]);

        Log::debug($response->getContent());

        $response
            ->assertStatus(200)
            ->assertJsonPath('data.0.name', Owner::first()->fullName());
    }
}
