<?php

namespace Tests\Unit;

use App\Owner;
use Illuminate\Database\QueryException;
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

    public function testTelephoneNumberTooLong()
    {
        $this->expectException(QueryException::class);

        $ownerFromDB = Owner::all()->first();
        $ownerFromDB->telephone = "012345678912312398120981023";
        $ownerFromDB->save();
    }

    public function testValidPhoneNumber()
    {
        $ownerFromDB = Owner::all()->first();

        $ownerFromDB->telephone = "07887654629"; // Valid
        dump($ownerFromDB->validPhoneNumber());
        $this->assertTrue($ownerFromDB->validPhoneNumber());

        $ownerFromDB->telephone = "00441282616641"; // Valid
        $this->assertTrue($ownerFromDB->validPhoneNumber());

        $ownerFromDB->telephone = "0013126718855"; // Valid
        $this->assertTrue($ownerFromDB->validPhoneNumber());

        $ownerFromDB->telephone = "+441282616641"; // Invalid
        $this->assertFalse($ownerFromDB->validPhoneNumber());

        $ownerFromDB->telephone = "07887 654629"; // Invalid
        $this->assertFalse($ownerFromDB->validPhoneNumber());

        $ownerFromDB->telephone = "001 312 671 8855"; // Invalid
        $this->assertFalse($ownerFromDB->validPhoneNumber());

        $ownerFromDB->telephone = "null"; // Invalid
        $this->assertFalse($ownerFromDB->validPhoneNumber());

        $ownerFromDB->telephone = ""; // Invalid
        $this->assertFalse($ownerFromDB->validPhoneNumber());
    }
}
