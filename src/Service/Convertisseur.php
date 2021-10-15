<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class Convertisseur
{

    public function csvToArray($file) 
    {
        //$file = "../src/miniFrGer/small-french-client.csv";
        $csv = array_map('str_getcsv', file($file));
        array_walk($csv, function(&$a) use ($csv) {
        $a = array_combine($csv[0], $a);
            });
            array_shift($csv); # remove column header
            //var_dump($csv);
        
        return $csv;
    }
}
