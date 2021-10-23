<?php

namespace App\Service;

class Convertisseur
{

    public static function csvToArray($file)
    {
        //$file = "../src/Fichiers_CSV/small-french-client.csv";
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

    public static function arrayToCsv(array $input_array, string $filename, $delimiter = ',', $enclosure = '"', $escape_char = '\\')
    {
        if (isset($input_array[0])) {
            $fp = fopen($filename, 'w');

            /**
             * Printing headers
             */
            fputcsv($fp, array_keys($input_array[0]), $delimiter, $enclosure, $escape_char);

            /**
             * Writting data
             */
            foreach ($input_array as $row) {
                fputcsv($fp, $row, $delimiter, $enclosure, $escape_char);
            }

            fclose($fp);
        }
    }
    
}
