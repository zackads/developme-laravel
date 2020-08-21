<?php

namespace Tests\Unit;

use App\Treatment;
use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TreatmentFromStringTest extends TestCase
{
    use RefreshDatabase;

    public function testReturnsCollection()
    {
        $actual_value = Treatment::fromStrings(["Fel-O-Vax Lv-K", "Pecti-Cap", "Zymox Ear Cleanser"]);

        $this->assertInstanceOf(Collection::class, $actual_value);
    }

    public function testOnlyAcceptsArrays()
    {
        $this->expectException('TypeError');
        Treatment::fromStrings("this should be an array");
    }

    public function testReturnsInstanceOfTreatment()
    {
        $result = Treatment::fromString("Fel-O-Vax Lv-K");

        $this->assertInstanceOf(Treatment::class, $result);
        $this->assertSame("Fel-O-Vax Lv-K", $result->name);
    }

    public function testTrimsInput()
    {
        $result = Treatment::fromString(" Fel-O-Vax Lv-K   ");

        $this->assertInstanceOf(Treatment::class, $result);
        $this->assertSame("Fel-O-Vax Lv-K", $result->name);
    }

    public function testSavesToDB()
    {
        Treatment::fromString("Fel-O-Vax Lv-K");

        $treatmentFromDB = Treatment::all()->first();
        $this->assertInstanceOf(Treatment::class, $treatmentFromDB);
        $this->assertSame("Fel-O-Vax Lv-K", $treatmentFromDB->name);
    }

    public function testDoesntSaveExistingTreatmentToDB()
    {
        Treatment::fromString("Fel-O-Vax Lv-K");
        Treatment::fromString("Fel-O-Vax Lv-K");

        $this->assertSame(1, Treatment::where("name", "Fel-O-Vax Lv-K")->count());
    }

    public function testFromStringsSavesToDB()
    {
        Treatment::fromStrings(["Fel-O-Vax Lv-K", "Full Frontal Lobotomy", "Brain Vaporizer 3000"]);
        $treatmentFromDB = Treatment::all()->first();

        $this->assertInstanceOf(Treatment::class, $treatmentFromDB);
        $this->assertSame("Fel-O-Vax Lv-K", $treatmentFromDB->name);
    }

    public function testFromStringsHandlesMultipleStrings()
    {
        $result = Treatment::fromStrings(["Test", "Hammock"]);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertSame("Test", $result[0]->name);
        $this->assertSame("Hammock", $result[1]->name);
    }

    public function testFromStringsAddsMultipleStringsToDB()
    {
        $result = Treatment::fromStrings(["Test", "Driven", "Development"]);
        $treatmentFromDB = Treatment::all();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertSame("Test", $treatmentFromDB[0]->name);
        $this->assertSame("Driven", $treatmentFromDB[1]->name);
        $this->assertSame("Development", $treatmentFromDB[2]->name);
    }
}
