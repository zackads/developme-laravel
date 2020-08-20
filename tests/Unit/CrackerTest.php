<?php

namespace Tests\Unit;

use App\Cracker;
use PHPUnit\Framework\TestCase;

// Given an alphabet decryption key like the one below, create a program that can crack any message using the decryption key.

// Alphabet:

// a b c d e f g h i j k l m n o p q r s t u v w x y z

// Decryption Key:

// ! ) # ( . * % & > < @ a b c d e f g h i j k l m n o

class CrackerTest extends TestCase
{
    public function testA()
    {
        $this->cracker = new Cracker("!)#(.*%&><@abcdefghijklmno");
        $this->assertSame("a", $this->cracker->decryptMsg("!"));
    }

    public function testB()
    {
        $this->cracker = new Cracker("!)#(.*%&><@abcdefghijklmno");
        $this->assertSame("b", $this->cracker->decryptMsg(")"));
    }

    public function testC()
    {
        $this->cracker = new Cracker("!)#(.*%&><@abcdefghijklmno");
        $this->assertSame("c", $this->cracker->decryptMsg("#"));
    }

    public function testOtherDecryptionKeysZ()
    {
        $this->cracker = new Cracker("18293kfhd^&(@kfmbhsye'\][;");
        $this->assertSame("z", $this->cracker->decryptMsg(";"));
    }

    public function testOtherDecryptionKeysX()
    {
        $this->cracker = new Cracker("18293kfhd^&(@kfmbhsye'\][;");
        $this->assertSame("y", $this->cracker->decryptMsg("["));
    }

    public function testOtherDecryptionKeysY()
    {
        $this->cracker = new Cracker("18293kfhd^&(@kfmbhsye'\][;");
        $this->assertSame("x", $this->cracker->decryptMsg("]"));
    }

    public function testMultiCharMessage()
    {
        $this->cracker = new Cracker("!)#(.*%&><@abcdefghijklmno");
        $this->assertSame("hello", $this->cracker->decryptMsg("&.aad"));
    }

    public function testMultiCharMessageWithWhitespace()
    {
        $this->cracker = new Cracker("!)#(.*%&><@abcdefghijklmno");
        $this->assertSame("hello world", $this->cracker->decryptMsg("&.aad ldga("));
    }

    public function testNonAlphaChars()
    {
        $this->cracker = new Cracker("!)#(.*%&><@abcdefghijklmno");
        $this->assertSame("hello? world^", $this->cracker->decryptMsg("&.aad? ldga(^"));
    }

    public function testMoreNonAlphaChars()
    {
        $this->cracker = new Cracker("!)#(.*%&><@abcdefghijklmno");
        $this->assertSame("123456", $this->cracker->decryptMsg("123456"));
    }

    public function testDecryptMsgSetter()
    {
        $this->cracker = new Cracker("!)#(.*%&><@abcdefghijklmno");
        $this->cracker->setDecryptionKey("qwertyuiop[]\';lkjhgfdsa/.");

        $this->assertSame("abcde", $this->cracker->decryptMsg("qwert"));
    }

    public function testFull()
    {
        $cracker = new Cracker("!)#(.*%&><@abcdefghijklmno");
        $this->assertSame("hello mum", $cracker->decryptMsg("&.aad bjb"));
    }

}
