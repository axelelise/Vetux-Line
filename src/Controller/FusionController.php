<?php

namespace App\Controller;

use App\Form\FormMelangeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Convertisseur;
use App\Service\Fusion;

class FusionController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index1(Request $request): Response
    {

        $form = $this->createForm(FormMelangeType::class);
        
        
        $form->handleRequest($request);
        if($form->isSubmitted()){
            
            $choix = $form["type"]->getData();

            return $this->redirectToRoute('test',['choixMelange' => $choix,]);
        }

        return $this->render('Mission 1/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    

    
    /**
     * @Route("/test/{choixMelange}", name="test")
     */

    public function csvToArrays(Convertisseur $convertisseur, $choixMelange, Fusion $fusion) 
    {
        /* $file = "../src/miniFrGer/small-french-client.csv";
        $tab1 = $convertisseur->csvToArray($file);
        
        $file = "../src/miniFrGer/small-german-client.csv";
        $tab2 = $convertisseur->csvToArray($file); */

        /**
         * Recuperer le type de melange 
         * Faire les melanges selon l'utilisateur
         * Creer le tab3 
         * Revoyer le tab3 dans l'affichage pour valider 
         */

        /* if($choixMelange === "Entrelacé"){
            
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

        }
        elseif($choixMelange === "Séquentiel"){
            for($i=0;$i<count($tab1);$i++){
                $tab3[] = $tab1[$i];
            }
            for($i=0;$i<count($tab2);$i++){
                $tab3[] = $tab2[$i];
            }
        }
        else{
            return $this->redirectToRoute('index');
        }

        $longueurTab3 = count($tab3);

        $colonneUtiliser = ["Gender","Title","GivenName","Surname","EmailAddress","Birthday","TelephoneNumber","CCType","CCNumber","CVV2","CCExpires","StreetAddress","City","StateFull","ZipCode","CountryFull","FeetInches","Centimeters","Pounds","Vehicle","Latitude","Longitude"];
        $cbUtiliser = [];

        for($i=0; $i<$longueurTab3;$i++){

            foreach($tab3[$i] as $key => $value){
                if(in_array($key,$colonneUtiliser)){

                }
                else{
                    unset($tab3[$i][$key]);
                }
            }

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
        }    */

        $file1 = "../src/miniFrGer/small-french-client.csv";
        
        $file2 = "../src/miniFrGer/small-german-client.csv";

        $tableauMelanger = $fusion->fusion($file1, $file2, $choixMelange, $convertisseur);

        $tableauUniquementColonneBesoin = $fusion->projection($tableauMelanger);

        $tableauTrier = $fusion->selection($tableauUniquementColonneBesoin, $convertisseur);

        return $this->render('Mission 1/tableau.html.twig', [
            'tableau' => $tableauTrier
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('Mission 1/upload.html.twig');
    }
}

?> 