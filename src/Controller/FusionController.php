<?php

namespace App\Controller;

use App\Form\FormMelangeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

            return $this->render('Mission 1/index.html.twig', [
                'choix' => $choix
            ]);
        }

        return $this->render('Mission 1/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    function Convertisseur($taille_inch){
        $Resultat = $taille_inch * 2.54;
        echo($Resultat);
        return $Resultat;
    }

    
    /**
     * @Route("/test", name="test")
     */

    public function csvToArray() 
    {
        $file = "../src/miniFrGer/small-french-client.csv";
        $csv = array_map('str_getcsv', file($file));
        array_walk($csv, function(&$a) use ($csv) {
        $a = array_combine($csv[0], $a);
            });
            array_shift($csv); # remove column header
            //var_dump($csv);
        return $this->redirectToRoute('index' , array(
            'tableau1' => $csv,));
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