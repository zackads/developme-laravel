<?php

namespace Tests\Unit;

use App\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Owner::create([
            "first_name" => "Watchy",
            "last_name" => "McWatchface",
            "telephone" => "0121DOONE",
            "email" => "f91w@casio.com",
        ]);
    }

    public function testFieldsAreCorrect()
    {
        $ownerFromDB = Owner::all()->first();

        $this->assertSame($ownerFromDB->first_name, "Watchy");
        $this->assertSame($ownerFromDB->last_name, "McWatchface");
        $this->assertSame($ownerFromDB->telephone, "0121DOONE");
        $this->assertSame($ownerFromDB->email, "f91w@casio.com");
    }

    public function testEmailFound()
    {
        $ownerFromDB = Owner::all()->first();

        $this->assertTrue($ownerFromDB->checkOwnerExists("f91w@casio.com"));
    }

    public function testEmailNotFound()
    {
        $ownerFromDB = Owner::all()->first();
        $this->assertFalse($ownerFromDB::checkOwnerExists("g-shockw@casio.com"));
    }
}
