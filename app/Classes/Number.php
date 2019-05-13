<?php

namespace App\Classes;

/**
 *
 */
class Number
{

    static public $primeNumbers = [];

    /**
     * Generates primer numbers in a given range
     *
     * @param int $from range start
     * @param int $to range end
     * @return return array
     */
    public static function generatePrimes($from, $to)
    {

        foreach (range($from, $to) as $number) {
            if (self::isPrime($number)) {
                self::$primeNumbers[] = $number;
            }
        }

        return self::$primeNumbers;

    }

    static function isPrime($number)
    {

        if ($number == 1) {
            return false;
        }

        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) {
                return false;
            }
        }
        
        return true;
    }


}
