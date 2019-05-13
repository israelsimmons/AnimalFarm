<?php

require_once 'vendor/autoload.php';

use App\Classes\Goat;
use App\Classes\Sheep;
use App\Classes\Number;
use App\Classes\Barn;
use App\Classes\Farm;

// Implementation of Mustache Template Engine to ease the HTML output
// https://github.com/bobthecow/mustache.php
$tplNgin = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '\app\views'),
));

// This prime numbers will serve as serials for each animal in each barn
$primeNumbers = Number::generatePrimes(1, 10000);

// how many animals?
$qty = 100;

// Populate both barns with 100 animals
$barn1 = Barn::populate(100, 'Sheep', $primeNumbers);
$barn2 = Barn::populate(100, 'Goat', $primeNumbers);

// Create a farm with both barns
$farm = new Farm($barn1, $barn2);

// We can also do this for the same purpose of creating a Farm and add barns
// $farm = new Farm();
// $farm->addBarn($barn1);
// $farm->addBarn($barn2);

// Write the results
$barn1->writeCensus('sheep');
$barn2->writeCensus('goat');
$farm->writeSoulmates(1, 2, 'soulmates');

echo $tplNgin->render('statistics', compact(
    'barn1', 'barn2'
));
