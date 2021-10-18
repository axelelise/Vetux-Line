<?php

namespace App\Service;
use App\Service\Convertisseur;

class Fusion
{
    public function fusion($file1, $file2, $typeMelange, Convertisseur $convertisseur){
        $tab1 = $convertisseur->csvToArray($file1);
        $tab2 = $convertisseur->csvToArray($file2);

        if($typeMelange === "Entrelacé"){
            
            $logueurMax = 0;
            if(count($tab1)>count($tab2)){
                $logueurMax = count($tab1);
            }
            else{
                $logueurMax = count($tab2);
            }

            for($i=0; $i<$logueurMax; $i++){
                if($i < count($tab1)){
                    $tab3[] = $tab1[$i]; 
                }
                if($i < count($tab2)){
                    $tab3[] = $tab2[$i]; 
                }
            }

            return $tab3;

        }

        elseif($typeMelange === "Séquentiel"){
            for($i=0;$i<count($tab1);$i++){
                $tab3[] = $tab1[$i];
            }
            for($i=0;$i<count($tab2);$i++){
                $tab3[] = $tab2[$i];
            }
        
            return $tab3;

        }
        else{
            return "ERREUR";
        }
    } 
    
    public function projection ($tab3){
        
        $longueurTab3 = count($tab3);

        $colonneUtiliser = ["Gender","Title","GivenName","Surname","EmailAddress","Birthday","TelephoneNumber","CCType","CCNumber","CVV2","CCExpires","StreetAddress","City","StateFull","ZipCode","CountryFull","FeetInches","Centimeters","Pounds","Vehicle","Latitude","Longitude"];

        for($i=0; $i<$longueurTab3;$i++){

            foreach($tab3[$i] as $key => $value){
                if(in_array($key,$colonneUtiliser)){

                }
                else{
                    unset($tab3[$i][$key]);
                }
            }
        }

        return $tab3;
    }
    
    public function selection($tab3, $convertisseur){

        $longueurTab3 = count($tab3);
        $cbUtiliser = [];

        for($i=0; $i<$longueurTab3;$i++){
            $age = $convertisseur->age($tab3[$i]["Birthday"]);
            
            if($age < 18){
                unset($tab3[$i]);
            }

            elseif($tab3[$i]["FeetInches"]!= $convertisseur->cmToFeet($tab3[$i]["Centimeters"])){
                unset($tab3[$i]);
            }

            elseif(in_array($tab3[$i]["CCNumber"], $cbUtiliser)){
                unset($tab3[$i]);
            }
            
            else{
                $cbUtiliser [] = $tab3[$i]["CCNumber"];
            }
        }  
        
        return $tab3;

    }
}
