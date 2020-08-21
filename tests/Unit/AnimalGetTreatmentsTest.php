<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Animal;
use Illuminate\Foundation\Testing\RefreshDatabase;


class AnimalGetTreatmentsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testGetTreatmentsReturnsArrayOfTreatments()
    {
        $animal = Animal::all()->random();
        $treatments = ["Fiddle with her ears", "Rub her on the belly", "Tell her she's a good girl"];
        $animal->setTreatments($treatments);

        $this->assertSame($animal->getTreatments(), $treatments);
    }
}
