<?php declare(strict_types=1);

namespace App\Tests;

use App\DomainForwarding;
use PHPUnit\Framework\TestCase;

final class DomainForwardingTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            DomainForwarding::class,
            new DomainForwarding([
                ["a-b.c", "a.c"],
                ["aa-b.c", "a-b.c"],
                ["bb-b.c", "a-b.c"],
                ["cc-b.c", "a-b.c"],
                ["d-cc-b.c", "bb-b.c"],
                ["e-cc-b.c", "bb-b.c"]
            ]));
    }

    public function testGenerateGroupsDomains()
    {
        $this->assertEquals(
            [["a-b.c", "a.c", "aa-b.c", "bb-b.c", "cc-b.c", "d-cc-b.c", "e-cc-b.c"]],
            (new DomainForwarding([
                ["a-b.c", "a.c"],
                ["aa-b.c", "a-b.c"],
                ["bb-b.c", "a-b.c"],
                ["cc-b.c", "a-b.c"],
                ["d-cc-b.c", "bb-b.c"],
                ["e-cc-b.c", "bb-b.c"]
            ]))->generateGroupsDomains()
        );
    }
}


