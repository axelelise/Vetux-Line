<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class NavigationController extends AbstractController
{
    /**
     * @Route("/", name="first")
     */
    public function firstPage()
    {
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/membre", name="membre")
     */
    public function membre()
    {
      $this->denyAccessUnlessGranted('ROLE_USER');
        $return = [];
        return $this->render('navigation/membre.html.twig', $return);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
      $this->denyAccessUnlessGranted('ROLE_ADMIN');
      return $this->render('navigation/admin.html.twig');
    }

}
