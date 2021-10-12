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
    public function index(Request $request): Response
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
}
?> 