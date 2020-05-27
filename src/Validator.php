<?php declare(strict_types=1);

namespace App;

/**
 * Class Validator
 * @package App
 */
class Validator
{

    /**
     * @param int $value
     * @param int $min
     * @param int $max
     * @return bool
     */
    static function intValue(int $value, int $min,int $max): bool
    {
        if($min <= $value && $value <= $max) {
            return true;
        }
        return false;
    }

    /**
     * @param float $value
     * @param float $min
     * @param float $max
     * @return bool
     */
    static function floatValue(float $value, float $min,float $max): bool
    {
        if($min <= $value && $value <= $max) {
            return true;
        }
        return false;
    }

    /**
     * @param array $array
     * @param int $min
     * @param int $max
     * @return bool
     */
    static function arrayLength(array $array ,int $min,int $max): bool
    {
        if($min <= count($array) && count($array) <= $max) {
            return true;
        }
        return false;

    }

    /**
     * @param string $string
     * @param int $min
     * @param int $max
     * @return bool
     */
    static function stringLength(string $string ,int $min,int $max): bool
    {
        if($min <= strlen($string) && strlen($string) <= $max) {
            return true;
        }
        return false;
    }

    /**
     * @param array $array1
     * @param array $array2
     * @return bool
     */
    static function arraysLengthEquals(array $array1, array $array2): bool
    {
        if(count($array1) === count($array2)) {
            return true;
        }
        return false;
    }

    /**
     * @param array $array
     * @return bool
     */
    static function arrayContainsTupleString(array $array): bool
    {
        foreach ($array as $item) {
           if(count($item) !== 2) {
               return false;
           } else {
               if(!is_string($item[0]) || !is_string($item[1])) {
                   return false;
               }
           }
        }
        return true;
    }

    /**
     * @param array $array
     * @return bool
     */
    static function arrayNotRepeatFirstTupleItem(array $array): bool
    {
        $firstElements = [];
        foreach ($array as $key => $item) {
           $firstElements[] = $item[0];
        }
        foreach (array_count_values($firstElements) as $value) {
           if($value >= 2){
               return false;
           }
        }
        return true;
    }

    /**
     * @param array $array
     * @param string|null $search
     * @return bool
     */
    static function arrayTupleContainsCycle(array $array,string $search = null): bool
    {
        $initElement = array_shift($array);

        if(is_null($search)) {
            $search = $initElement[0];
        }
        if($search === $initElement[1]) {
            return true;
        }

        foreach ($array as $item) {
            if($initElement[1] === $item[0]){
                return self::arrayTupleContainsCycle($array, $search);
            }
        }
        return false;
    }
}