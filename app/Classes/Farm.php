<?php

namespace App\Classes;

class Farm
{

    private $barns = [];
    private $soulmates = [];

    function __construct(...$barns)
    {
        $this->barns = $barns;
    }

    /**
     * Writes the serial number of the matching serials in both barns
     *
     * @param int $barn1 positive number > 0 of the barn
     * @param int $barn2 positive number > 0 of the barn
     * @param string $file filename to write
     * @return return boolean
     */
    function writeSoulmates(int $barn1, int $barn2, $file) : bool
    {
        // Calculate the real index of the barn in the array
        $barn1Index = $barn1 -1;
        $barn2Index = $barn2 -1;

        // Use php function for calculate those keys that intersect eachother
        $arrResult = array_intersect_key(
            $this->barns[$barn1Index]->animalArr,
            $this->barns[$barn2Index]->animalArr
        );

        // get the keys we are writing into the file
        $soulmatesKeys = \array_keys($arrResult);

        // catch potential exception in case the I/O operation fails
        try {
            $file = fopen($file . '.txt', 'w');

            foreach($soulmatesKeys as $key) {
                fwrite($file, $this->barns[$barn1Index]->animalArr[$key]->serial . "\n");
            }

            fclose($file);
        } catch (\Exception $e) {
            return false;
        }

        return true;

    }

    /**
     * Add a new barn to the farm
     *
     * @param Barn $barn an instance of the Barn class
     * @return return boolean
     */
    public function addBarn(Barn $barn) : bool
    {
        // we could validate the Barn and return false
        // in case something is wrong

        $this->barns[] = $barn;

        return true;
    }

}
