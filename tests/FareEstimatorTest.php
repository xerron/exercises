<?php declare(strict_types=1);

namespace App\Tests;

use App\FareEstimator;
use PHPUnit\Framework\TestCase;

final class FareEstimatorTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $rideTime = 30;
        $rideDistance = 7;
        $costPerMinute = [0.2, 0.35, 0.4, 0.45];
        $costPerMile = [1.1, 1.8, 2.3, 3.5];

        $this->assertInstanceOf(
            FareEstimator::class,
            new FareEstimator($rideTime, $rideDistance, $costPerMinute, $costPerMile)
        );
    }
}


