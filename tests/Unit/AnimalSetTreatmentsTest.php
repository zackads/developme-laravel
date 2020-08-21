<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Animal;
use App\Treatment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnimalSetTreatments extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testIsInstanceOfTreatmentClass()
    {
        $animal = Animal::all()->random();
        $animal->setTreatments(["Amputate leg", "Rub tummy"]);

        foreach ($animal->treatments as $treatment) {
            $this->assertInstanceOf(Treatment::class, $treatment);
        }
    }

    public function testTreatmentName()
    {
        $animal = Animal::all()->random();
        $treatment_strings = ["Amputate leg", "Rub tummy", "Tell him he's a good boy"];

        $animal->setTreatments($treatment_strings);

        $this->assertSame($treatment_strings[0], $animal->treatments->find(1)->name);
        $this->assertSame($treatment_strings[1], $animal->treatments->find(2)->name);
        $this->assertSame($treatment_strings[2], $animal->treatments->find(3)->name);
    }
}
