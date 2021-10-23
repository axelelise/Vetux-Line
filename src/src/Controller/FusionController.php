<?php

namespace App\Controller;

use App\Form\FormMelangeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Convertisseur;
use App\Service\Fusion;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class FusionController extends AbstractController
{

    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * Controller pour Upload
     *
     * @Route("/upload", name="upload")
     */
    public function upload()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('Fusion/upload.html.twig');
    }

    /**
     * Formulaire concernant le type de mélange.
     *
     * @Route("/choix", name="choix")
     */
    public function choix(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(FormMelangeType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            
            $choix = $form["type"]->getData();

            return $this->redirectToRoute('fusion',['choixMelange' => $choix,]);
        }

        return $this->render('Fusion/formulaire_choix.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
    /**
     * Fusionne les 2 fichier importer et les places dans un fichier appart
     *
     * @Route("/fusion/{choixMelange}", name="fusion")
     */

    public function fusion(Convertisseur $convertisseur, $choixMelange, Fusion $fusion)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        // Lancement de la session
        $session = $this->requestStack->getSession();

        // Recuperation des noms de fichier stocker dans la session lors de upload
        $file1 = $session->get('fichier1');
        $file2 = $session->get('fichier2');

        // La fonction fusion supprime les colonnes inutiles, fait un trie
        // et renvoi un tableau associatif contenant les 2 fichiers mélangé
        $tableauMelangerEtTrier = $fusion->fusion($file1, $file2, $choixMelange);

        // Ont replace le contenu de notre tableau associatif dans un autre tableau pour eviter les
        // clées vide a cause du trie ( [0]=> , [1]=> ["pays"] => "France")
        foreach ($tableauMelangerEtTrier as $tab){
            $tableauFini [] = $tab;
        }

        // Initalise un fichier Csv depuis notre tableau associatif
        Convertisseur::arrayToCsv($tableauFini, '../src/Fichiers_CSV/french_german_client.csv');


        return $this->render('Fusion/download.html.twig');
    }

    /**
     * Permet à l'utilisateur de télécharger le fichier csv qui comprend la fusion
     * des 2 fichiers importés
     *
     * @Route("/download", name="download_file")
     **/
    public function downloadFileAction(){
        $response = new BinaryFileResponse('../src/Fichiers_CSV/french_german_client.csv');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,'french-german-client_'.date('d-m-Y').'.csv');
        return $response;
    }

}

?> 