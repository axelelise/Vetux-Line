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
    public static function projection ($tab3){
        
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
    public static function selection($tab3){

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

    public static function etl ($tab){

        $entityManager = $this->getDoctrine()->getManager();

        for($i=0; $i<count($tab); $i++){

            $client = new Client();
            $client->setGenre($tab[$i]["Gender"]);
            $client->setTitre($tab[$i]["Title"]);
            $client->setNom($tab[$i]["GivenName"]);
            $client->setPrenom($tab[$i]["Surname"]);
            $client->setEmail($tab[$i]["EmailAddress"]);
            $client->setDateDeNaissance($tab[$i]["Birthday"]);
            $client->setNumTel($tab[$i]["TelephoneNumber"]);
            $client->setCCType($tab[$i]["CCType"]);
            $client->setCCNumber($tab[$i]["CCNumber"]);
            $client->setCCExpires($tab[$i]["CCExpires"]);
            $client->setCVV2 ($tab[$i]["CVV2"]);
            $client->setAdressePhysique($tab[$i]["StreetAddress"]);
            $client->setCity($tab[$i]["City"]);
            $client->setState($tab[$i]["State"]);
            $client->setCodePostal($tab[$i]["ZipCode"]);
            $client->setRegion($tab[$i]["CountryFull"]);
            $client->setFeetInch($tab[$i]["FeetInches"]);
            $client->setTaille($tab[$i]["Centimeters"]);
            $client->setPoids($tab[$i]["Pounds"]);
            $client->setLatitude($tab[$i]["Latitude"]);
            $client->setLongitude($tab[$i]["Longitude"]);
            $entityManager->persist($client);
            $entityManager->flush();

            $infoVehicules = explode(' ',$tab[$i]["Vehicle"]);
            $annee = $infoVehicules[0];
            $marque = $infoVehicules[1];
            $modele = $infoVehicules[2];

            $vehicule = new Vehicule();
            $vehicule->setModele($modele);
            $vehicule->setAnnee($annee);
            $entityManager->persist($vehicule);
            $entityManager->flush();

            $marque = new Marque();
            $marque->setNom($marque);
            $entityManager->persist($marque);
            $entityManager->flush();

        }
    }
}
