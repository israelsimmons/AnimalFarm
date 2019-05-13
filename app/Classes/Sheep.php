<?php

namespace App\Classes;

class Sheep extends Animal
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    public function __construct($serial)
    {
        parent::__construct($serial);

        $this->sound = 'Baa!';
    }
}
