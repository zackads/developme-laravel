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

    public function testStoreRejectsInvalidName()
    {
        $owner_id = Owner::all()->random()->id;

        $response = $this->actingAs(user::first())
            ->withHeaders(['Accept' => "application/json"])
            ->json('POST', "/api/animals/", [
                "name" => "This string is longer than 100 characters zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz",
                "type" => "diva",
                "dob" => "1996-03-10",
                "weight" => 0.4,
                "height" => 0.8,
                "biteyness" => 4,
                "owner_id" => $owner_id,
                "treatments" => ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]
            ]);

        $response->assertStatus(422);
    }

    public function testStoreRejectsInvalidType()
    {
        $owner_id = Owner::all()->random()->id;

        $response = $this->actingAs(user::first())
            ->withHeaders(['Accept' => "application/json"])
            ->json('POST', "/api/animals/", [
                "name" => "Miss Kitty Fantastico",
                "type" => "This string is longer than 100 characters zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz",
                "dob" => "1996-03-10",
                "weight" => 0.4,
                "height" => 0.8,
                "biteyness" => 4,
                "owner_id" => $owner_id,
                "treatments" => ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]
            ]);

        $response->assertStatus(422);
    }

    public function testStoreRejectsInvalidDOB()
    {
        $owner_id = Owner::all()->random()->id;

        $response = $this->actingAs(user::first())
            ->withHeaders(['Accept' => "application/json"])
            ->json('POST', "/api/animals/", [
                "name" => "Miss Kitty Fantastico",
                "type" => "diva",
                "dob" => 42,
                "weight" => 0.4,
                "height" => 0.8,
                "biteyness" => 4,
                "owner_id" => $owner_id,
                "treatments" => ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]
            ]);

        $response->assertStatus(422);
    }

    public function testStoreRejectsInvalidWeight()
    {
        $owner_id = Owner::all()->random()->id;

        $response = $this->actingAs(user::first())
            ->withHeaders(['Accept' => "application/json"])
            ->json('POST', "/api/animals/", [
                "name" => "Miss Kitty Fantastico",
                "type" => "diva",
                "dob" => "1996-03-10",
                "weight" => "0.4lbs",
                "height" => 0.8,
                "biteyness" => 4,
                "owner_id" => $owner_id,
                "treatments" => ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]
            ]);

        $response->assertStatus(422);
    }

    public function testStoreRejectsInvalidHeight()
    {
        $owner_id = Owner::all()->random()->id;

        $response = $this->actingAs(user::first())
            ->withHeaders(['Accept' => "application/json"])
            ->json('POST', "/api/animals/", [
                "name" => "Miss Kitty Fantastico",
                "type" => "diva",
                "dob" => "1996-03-10",
                "weight" => 0.4,
                "height" => "0.8m",
                "biteyness" => 4,
                "owner_id" => $owner_id,
                "treatments" => ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]
            ]);

        $response->assertStatus(422);
    }

    public function testStoreRejectsInvalidBiteynessString()
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
                "biteyness" => "very bitey",
                "owner_id" => $owner_id,
                "treatments" => ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]
            ]);

        $response->assertStatus(422);
    }

    public function testStoreRejectsInvalidBiteynessNumber()
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
                "biteyness" => "very bitey",
                "owner_id" => $owner_id,
                "treatments" => ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]
            ]);

        $response->assertStatus(422);
    }

    public function testStoreRejectsInvalidOwnerId()
    {
        $invalid_owner_id = Owner::all()->last()->id + 1;

        $response = $this->actingAs(user::first())
            ->withHeaders(['Accept' => "application/json"])
            ->json('POST', "/api/animals/", [
                "name" => "Miss Kitty Fantastico",
                "type" => "diva",
                "dob" => "1996-03-10",
                "weight" => 0.4,
                "height" => 0.8,
                "biteyness" => 4,
                "owner_id" => $invalid_owner_id,
                "treatments" => ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"]
            ]);

        $response->assertStatus(422);
    }

    public function testShowSingleAnimalIncludesTreatments()
    {
        // Treatments to test
        $test_treatments = ["Veda-Sorb Bolus", "Keto-Gel", "QuickDerm Wound Ointment"];

        // Select an owner
        $owner_id = Owner::all()->random()->id;

        // Create new animal owned by that owner
        $animal_response = $this->actingAs(user::first())
            ->withHeaders(['Accept' => "application/json"])
            ->json('POST', "/api/animals/", [
                "name" => "Miss Kitty Fantastico",
                "type" => "diva",
                "dob" => "1996-03-10",
                "weight" => 0.4,
                "height" => 0.8,
                "biteyness" => 4,
                "owner_id" => $owner_id,
                "treatments" => $test_treatments
            ]);
        $animal_id = $animal_response->getData()->data->id;

        // Call API for animal details
        $response = $this->actingAs(User::first())
            ->json('GET', "/api/animals/{$animal_id}", ['Accept' => "application/json"]);

        // Assert treatments appear in the response JSON at data.treatments
        $response
            ->assertStatus(200)
            ->assertJsonPath("data.treatments", $test_treatments);
    }
}
