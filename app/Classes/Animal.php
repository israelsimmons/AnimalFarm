<?php

namespace App\Classes;

/**
 * Base class to give defaut functionality to those who extends this class
 */
class Animal
{

    public $serial;
    public $gender;

    public function __construct($serial)
    {
        $genders = ['M', 'F'];
        $this->serial = $serial;
        $this->gender = $genders = $genders[random_int(0, 1)];
    }

    function create() {}

    /**
     * Let the animal communicate
     *
     * Will return the sound the animal makes
     *
     * @return return String
     */
    public function speak() {

        if (property_exists($this, 'sound')) {
            return $this->sound . '<br>';
        } else {
            return 'I\'m speechless <br>';
        }

    }

}
