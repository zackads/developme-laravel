<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Animal;
use App\Owner;

class AnimalAPITest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testCORS()
    {
        $response = $this->actingAs(User::first())
            ->json(
                'GET',
                '/api/owners',
                ['Accept' => "application/json", "Origin" => "wombats.co.uk"]
            );

        $response->assertStatus(200)->assertHeader("Access-Control-Allow-Origin", $value = "*");
    }

    public function testListAllAnimals()
    {
        $response = $this->actingAs(User::first())
            ->json('GET', '/api/animals', ['Accept' => "application/json"]);

        foreach (Animal::all() as $i => $animal) {
            $response
                ->assertStatus(200)
                ->assertJsonPath("data.{$i}.id", $animal->id)
                ->assertJsonPath("data.{$i}.name", $animal->name)
                ->assertJsonPath("data.{$i}.dob", $animal->dob)
                ->assertJsonPath("data.{$i}.weight", $animal->weight)
                ->assertJsonPath("data.{$i}.height", $animal->height)
                ->assertJsonPath("data.{$i}.owner", $animal->owner->fullName());
        }
    }

    public function testShowSingleAnimal()
    {
        $animal_id = Animal::all()->random()->id;

        $response = $this->actingAs(User::first())
            ->json('GET', "/api/animals/{$animal_id}", ['Accept' => "application/json"]);

        $response
            ->assertStatus(200)
            ->assertJsonPath("data.id", Animal::find($animal_id)->id)
            ->assertJsonPath("data.name", Animal::find($animal_id)->name)
            ->assertJsonPath("data.type", Animal::find($animal_id)->type)
            ->assertJsonPath("data.dob", Animal::find($animal_id)->dob)
            ->assertJsonPath("data.weight", Animal::find($animal_id)->weight)
            ->assertJsonPath("data.height", Animal::find($animal_id)->height)
            ->assertJsonPath("data.biteyness", Animal::find($animal_id)->biteyness)
            ->assertJsonPath("data.owner", Animal::find($animal_id)->owner->fullName());
    }

    public function testUpdateSingleAnimal()
    {
        $animal_id = Animal::all()->random()->id;

        $response = $this->actingAs(User::first())
            ->withHeaders(['Accept' => "application/json"])
            ->json('GET', "/api/animals/{$animal_id}");

        $response
            ->assertStatus(200)
            ->assertJsonPath("data.id", Animal::find($animal_id)->id)
            ->assertJsonPath("data.name", Animal::find($animal_id)->name)
            ->assertJsonPath("data.type", Animal::find($animal_id)->type)
            ->assertJsonPath("data.dob", Animal::find($animal_id)->dob)
            ->assertJsonPath("data.weight", Animal::find($animal_id)->weight)
            ->assertJsonPath("data.height", Animal::find($animal_id)->height)
            ->assertJsonPath("data.biteyness", Animal::find($animal_id)->biteyness)
            ->assertJsonPath("data.owner", Animal::find($animal_id)->owner->fullName());
    }

    public function testStoreReturns201()
    {
        $owner_id = Owner::all()->random()->id;

        $response = $this->actingAs(user::first())
            ->withHeaders(['Accept' => "application/json"])
            ->json('POST', "/api/animals/", [
                "name" => "Miss Kitty Fantastico",
                "type" => "diva",
                "dob" => "1996-03-10",
                "weight" => 0.4,
                "height" => 0.8,
                "biteyness" => 4,
                "owner_id" => $owner_id,
                "treatments" => ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]
            ]);

        $response->assertStatus(201);
    }
}
