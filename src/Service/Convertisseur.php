<?php

namespace App\Service;

class Convertisseur
{

    public static function csvToArray($file)
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

    public function age($dateMauvaisFormat) { 
        $date = explode("/", $dateMauvaisFormat);
            if(count($date)<=2){
                $age=0;
                return $age;
            }
        $dateBonFormat = $date[2]."-".$date[1]."-".$date[0];
        //var_dump($dateBonFormat);
        $date = explode("-", $dateBonFormat);
        $age = date('Y') - $date[0]; 
        if (date('m') < $date[2]) { 
           $age--;
        } 
        elseif(date('d') < $date[1]){
            $age--;
        }
       return $age; 
   } 

    public function cmToFeet($cm)
    {
         $inches = $cm/2.54;
         $feet = intval($inches/12);
         $inches = $inches%12;
         return sprintf("%d' %d".'"', $feet, $inches);
    }
    
}
