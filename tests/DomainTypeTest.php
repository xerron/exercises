<?php declare(strict_types=1);

namespace App\Tests;

use App\DomainType;
use PHPUnit\Framework\TestCase;

final class DomainTypeTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            DomainType::class,
            new DomainType(["es.wiki.org", "codefights.com", "happy.net", "code.info"])
        );
    }

    public function testGetDictionary()
    {
        $this->assertEquals(
            [
                "org" => "organizacion",
                "com" => "comercial",
                "net" => "red",
                "info" => "informacion"
            ],
            (new DomainType())->getDictionary()
        );

    }

    public function testShowDomainsType()
    {
        $this->assertEquals(
            ["organizacion", "comercial", "red", "informacion"],
            (new DomainType(["es.wiki.org", "codefights.com", "happy.net", "code.info"]))->show()
        );

    }


}


