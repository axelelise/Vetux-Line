<?php

namespace App\Service;
use App\Service\Convertisseur;

class Fusion
{
    /**
     * @param $file1 string Fichier 1 importé par l'utilisateur
     * @param $file2 string Fichier 2 importé par l'utilisateur
     * @param $typeMelange string Choix du mélange (Entrelacé ou Séquentiel)
     * @return array
     */

    public static function fusion($file1, $file2, $typeMelange){

        // Convertie le fichier en tableau associatif
        $tab = Convertisseur::csvToArray($file1);

        // Supprime les colonnes inutiles
        $tab = self::projection($tab);

        // Trie les données
        $tab = self::selection($tab);

        // Ont replace le contenu de notre tableau associatif dans un autre tableau pour éviter les
        // clées vide a cause du trie ( [0]=> , [1]=> ["pays"] => "France")
        foreach ($tab as $tab){
            $tab1 [] = $tab;
        }

        $tab = Convertisseur::csvToArray($file2);
        $tab = self::projection($tab);
        $tab = self::selection($tab);

        foreach ($tab as $tab){
            $tab2 [] = $tab;
        }

        // Melange les valeurs des tableaux selon le choix de l'utilisateur
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
    }

    /**
     * @param $tab3 array
     * @return array avec seulement les colonnes voulu
     */
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

    /**
     * @param $tab3 array
     * @return array trier
     */
    public function selection($tab3){

        $longueurTab3 = count($tab3);
        $cbUtiliser = [];

        for($i=0; $i<$longueurTab3;$i++){
            $age = Convertisseur::age($tab3[$i]["Birthday"]);
            
            if($age < 18){
                unset($tab3[$i]);
            }

            elseif($tab3[$i]["FeetInches"]!= Convertisseur::cmToFeet($tab3[$i]["Centimeters"])){
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
