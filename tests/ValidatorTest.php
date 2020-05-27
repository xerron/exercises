<?php declare(strict_types=1);

namespace App\Tests;

use App\Domain;
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
}


