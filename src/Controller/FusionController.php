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