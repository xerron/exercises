<?php declare(strict_types=1);

namespace App\Tests;

use App\Domain;
use PHPUnit\Framework\TestCase;

final class DomainTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Domain::class,
            new Domain('user.example.com')
        );
    }

    public function testIsValid()
    {
        $this->assertEquals(
            true,
            (new Domain('www.u-w-u.com'))->isValid()
        );
    }

    public function testGetPublicSuffix()
    {
        $this->assertEquals(
            'com',
            (new Domain('www.u-w-u.com'))->getPublicSuffix()
        );
    }

}


