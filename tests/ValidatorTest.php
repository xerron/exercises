<?php declare(strict_types=1);

namespace App\Tests;

use App\Domain;
use App\Validator;
use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Domain::class,
            new Domain('user.example.com')
        );
    }

    public function testIntValue()
    {
        $this->assertEquals(
            false,
            Validator::intValue(3, 4,10)
        );
    }

    public function testFloatValue()
    {
        $this->assertEquals(
            true,
            Validator::floatValue(10.0, 4.1,10.1)
        );
    }

    public function testArrayLength()
    {
        $this->assertEquals(
            true,
            Validator::arrayLength([1,2,3,4,5,6], 4,10)
        );
    }

    public function testStringLength()
    {
        $this->assertEquals(
            true,
            Validator::stringLength('hello-world', 4,20)
        );

    }

    public function testArrayLengthEquals()
    {
        $this->assertEquals(
            true,
            Validator::arraysLengthEquals([1,2,3,4,5], [6,7,8,9,10])
        );

    }

    public function testArrayContainsTupleStrings()
    {
        $this->assertEquals(
            true,
            Validator::arrayContainsTupleString([["a", "b"], ["c", "d"]])
        );
    }

    public function testArrayNotRepeatFirstTupleItem()
    {
        $this->assertEquals(
            true,
            Validator::arrayNotRepeatFirstTupleItem([[1,2], [3,4], [4,5]])
        );
    }


}


