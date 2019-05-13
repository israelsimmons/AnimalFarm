<?php

namespace App\Interfaces;

interface Statistics
{
    function getSum();
    function getAvg();
    function getMedian();
    function getSkewness();
}
