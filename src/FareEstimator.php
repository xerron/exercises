<?php

declare(strict_types=1);

namespace App;

class FareEstimator
{
    /**
     * @var int
     */
    private $rideTime;
    /**
     * @var int
     */
    private $rideDistance;
    /**
     * @var array
     */
    private $costPerMinute;
    /**
     * @var array
     */
    private $costPerMile;

    public function __construct(int $rideTime,int $rideDistance, $costPerMinute, $costPerMile)
    {
        $this->rideTime = $rideTime;
        $this->rideDistance = $rideDistance;
        $this->costPerMinute = $costPerMinute;
        $this->costPerMile = $costPerMile;
    }

    public function calculate(): array
    {
        if(!Validator::arraysLengthEquals($this->costPerMinute, $this->costPerMile)) {
            throw new \Exception("Restriccion: Las longitudes de los arrays de costos no coinciden.");
        }

        if(!Validator::arrayLength($this->costPerMinute, 4,10)) {
            throw new \Exception("Restriccion:  No se encuentra en el rango 4 <= costPerMinute.length <= 10.");
        }

        if(!Validator::intValue($this->rideTime, 10,50)) {
            throw new \Exception("Restriccion: $this->rideTime no se encuentra en el rango 10 <= rideTime <= 50.");
        }

        if(!Validator::intValue($this->rideDistance, 5,20)) {
            throw new \Exception("Restriccion: $this->rideDistance no se encuentra en el rango 5 <= rideDistance <= 20.");
        }

        $arrayLength = count($this->costPerMinute);
        $estimate = [];

        for($i=0; $i < $arrayLength; $i++) {

            if(!Validator::floatValue($this->costPerMinute[$i], 0.1,350.0)) {
                throw new \Exception("Restriccion: {$this->costPerMinute[$i]} no se encuentra en el rango 0.1 <= costPerMinute <= 350.0");
            }

            if(!Validator::floatValue($this->costPerMile[$i], 0.5,7.0)) {
                throw new \Exception("Restriccion: {$this->costPerMile[$i]} no se encuentra en el rango 0.5 <= costPerMile <= 7.0");
            }

            $estimate[] = $this->costPerMinute[$i] * $this->rideTime + $this->costPerMile[$i] * $this->rideDistance;

        }

        return $estimate;
    }


}