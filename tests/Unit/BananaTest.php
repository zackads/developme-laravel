<?php

namespace Tests\Unit;

use App\Owner;
use PHPUnit\Framework\TestCase;

class BananaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->owner = new Owner;
    }

    public function testZeroArg()
    {
        $this->assertSame("No we have no bananas", $this->owner::haveWeBananas(0));
    }

    public function testPositiveInts()
    {
        foreach (range(1, 10) as $i) {
            $number = random_int(1, 99999999999);
            $this->assertSame("Yes we have {$number} bananas", $this->owner::haveWeBananas($number));
        }
    }

    public function testNegativeInts()
    {
        foreach (range(1, 10) as $i) {
            $number = -random_int(1, 99999999999);
            $this->assertSame("Yes we have {$number} bananas", $this->owner::haveWeBananas($number));
        }
    }

    public function testStrings()
    {
        $test_strings = ["canteloupe", "water", "honeydew", "citrullus ecirrhosus"];

        foreach ($test_strings as $string) {
            $this->assertSame("Yes we have {$string} bananas", $this->owner::haveWeBananas($string));
        }
    }

    public function testSingularBanana()
    {
        $this->assertSame($this->owner::haveWeBananas(1), "Yes we have 1 banana");
    }
}
