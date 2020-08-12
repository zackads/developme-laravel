<?php

namespace Tests\Unit;

use App\Owner;
use PHPUnit\Framework\TestCase;

class OwnerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->owner = new Owner;
        $this->owner->first_name = "Watchy";
        $this->owner->last_name = "McWatchface";
        $this->owner->telephone = "0121DOONE";
        $this->owner->email = "f91w@casio.com";
    }

    public function testFieldsAreCorrect()
    {
        $this->assertSame($this->owner->first_name, "Watchy");
        $this->assertSame($this->owner->last_name, "McWatchface");
        $this->assertSame($this->owner->telephone, "0121DOONE");
        $this->assertSame($this->owner->email, "f91w@casio.com");
    }

    public function testEmailNotFound()
    {
        $this->assertFalse($this->owner::checkOwnerExists("gshock@casio.com"));
    }
}
