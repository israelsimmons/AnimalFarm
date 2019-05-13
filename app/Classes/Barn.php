<?php

namespace App\Classes;

use App\Interfaces\Statistics;

class Barn implements Statistics
{

    public $animalArr = [];
    public $serials = [];
    private $filename = 'census';
    private $population = 0;

    /**
     * Constructor of the Barn class
     *
     * @param Array $animals filename to be writen
     * @return return void
     */
    public function __construct(array $animals = null)
    {

        // for convenience create an array where the keys are the serials
        // in case we need to store the whole object in an array
        // I also created an array of serials
        if (!$animals) {
            return;
        }

        foreach ($animals as $animal) {
            $this->animalArr[$animal->serial] = $animal;
            $this->serials[] = $animal->serial;
        }

        $this->population = count($this->animalArr);

    }

    /**
     * Writes all animals' serials to a txt file
     *
     * @param String $filename filename to be writen
     * @return return boolean
     */
    public function writeCensus(String $filename = null) : bool
    {

        // if a filename is not provided a default one is set
        $filename = $filename ?? $this->filename ;

        try {

            $file = fopen(strtolower($filename) . '.txt', 'w');

            foreach ($this->serials as $serial) {
                fwrite($file, $serial . "\n");
            }

            fclose($file);

        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * get the average of the serials
     *
     * @return return float
     */
    function getAvg() : float
    {
        $sum = 0;

        $sum = $this->getSum();

        return $sum / (count($this->serials));
    }

     /**
      * Calculate the median of the barn
      *
      * @return return float
      */
    function getMedian() : float
    {

        sort($this->serials);

        $pos1 = ceil(count($this->serials) / 2) -1;

        if (count($this->serials) % 2 == 0) {
            $pos2 = $pos1 + 1;
            $median = ($this->serials[$pos1] + $this->serials[$pos2]) / 2;
        } else {
            $median = $this->serials[$pos1];
        }

        return $median;
    }


     /**
      * get the total of animals in the barn
      *
      * @return return float
      */
    function getSum() : int
    {
        return array_sum($this->serials);
    }

    /**
     * undocumented function summary
     *
     * @return return type
     */
    public function getSkewness()
    {
        if ($this->getAvg() < $this->getMedian()) {
            $direction = 'right';
        } else {
            $direction = 'left';
        }

        return 'To the ' . $direction;
    }

    /**
     * Populate a barn with a specified number of animals
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    static function populate($qty, string $class, $serials)
    {

        $class = 'App\\Classes\\' . $class;

        if (!class_exists($class)) {
            throw new \Exception('The class ' . $class . ' is not defined' , 1);
        }

        $animals = [];

        for ($i=0; $i < $qty; $i++) {
            $position = random_int(0, count($serials) -1);
            $animals[] = new $class($serials[$position]);
            array_splice($serials, $position, 1);
        }

        return new Barn($animals);
    }
}
