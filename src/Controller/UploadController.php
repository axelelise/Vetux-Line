<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\FileUploader;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class UploadController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/doUpload", name="do-upload")
     * @param Request $request
     * @param FileUploader $uploader
     * @param LoggerInterface $logger
     * @return Response
     */
    public function index(Request $request, 
                      FileUploader $uploader, LoggerInterface $logger): Response
    {


        $file = $request->files->get('myfile');
        $file2 = $request->files->get('myfile2');

    

        if (empty($file))
        {
            return new Response("No file specified",
               Response::HTTP_UNPROCESSABLE_ENTITY, ['content-type' => 'text/plain']);
        }

        $filename = $file->getClientOriginalName();
        $uploader->upload('../src/Fichiers_CSV/', $file, $filename);

        $filename2 = $file2->getClientOriginalName();
        $uploader->upload('../src/Fichiers_CSV/', $file2, $filename2);

        $session = $this->requestStack->getSession();
        $session->set('fichier1', '../src/Fichiers_CSV/'.$filename);
        $session->set('fichier2', '../src/Fichiers_CSV/'.$filename2);

        return $this->redirectToRoute('choix');
    }
}