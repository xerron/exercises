<?php declare(strict_types=1);

require 'vendor/autoload.php';

use App\FareEstimator;

/**
 * Ejercicio 3
 */

$rideTime = 30;
$rideDistance = 7;
$costPerMinute = [0.2, 0.35, 0.4, 0.45];
$costPerMile = [1.1, 1.8, 2.3, 3.5];

$fe = new FareEstimator($rideTime, $rideDistance, $costPerMinute, $costPerMile);

try {
    echo implode(" , ", $fe->calculate());
} catch (Exception $e) {
    echo $e->getMessage();
}

//fareEstimator(ride_time, ride_distance, cost_per_minute, cost_per_mile) = [13.7, 23.1, 28.1, 38].
