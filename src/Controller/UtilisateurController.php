<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;


/**
 * @Route("/utilisateur")
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="utilisateur_index", methods={"GET"})
     */
    public function index(UtilisateurRepository $utilisateurRepository, Session $session): Response
    {

      $this->denyAccessUnlessGranted('ROLE_ADMIN');

      return $this->render('utilisateur/formulaire_choix.html.twig', [
                'utilisateurs' => $utilisateurRepository->findAll(),
            ]);

    }

    /**
     * @Route("/new", name="utilisateur_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordHasherInterface $passwordHasher, Session $session): Response
    {

      $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $utilisateur->setPassword(
                $passwordHasher->hashPassword($utilisateur, $utilisateur->getPassword()));

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('utilisateur_index');
        }

        return $this->render('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="utilisateur_show", methods={"GET"})
     */
    public function show(Utilisateur $utilisateur): Response
    {
        // voir fichier config security.yaml
       //  $this->denyAccessUnlessGranted('ROLE_USER');

      if( ($this->getUser()->getUserIdentifier()===$utilisateur->getUserIdentifier())
        || in_array("ROLE_ADMIN", $this->getUser()->getRoles()))
      {
        return $this->render('utilisateur/show.html.twig', [
          'utilisateur' => $utilisateur,
        ]);
      }
      return $this->redirectToRoute("upload");
    }

    /**
     * @Route("/{id}/edit", name="utilisateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Utilisateur $utilisateur,  UserPasswordHasherInterface $passwordHasher, Session $session, $id): Response
    {
        $utilisateur = $this->getUser();
        if($utilisateur->getId() != $id )
        {
            // un utilisateur ne peut pas en modifier un autre
            $this->addFlash("message", "Vous ne pouvez pas modifier cet utilisateur");
            return $this->redirectToRoute('membre');
        }
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setPassword(
                $passwordHasher->hashPassword($utilisateur, $utilisateur->getPassword()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('utilisateur_index');
        }

        return $this->render('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="utilisateur_delete", methods={"POST"})
     */
    public function delete(Request $request, Utilisateur $utilisateur, Session $session, $id): Response
    {
        $utilisateur = $this->getUser();
        if($utilisateur->getId() != $id )
        {
            // un utilisateur ne peut pas en supprimer un autre
          $this->addFlash("message", "Vous ne pouvez pas supprimer cet utilisateur");
            return $this->redirectToRoute('membre');
        }

        if ($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token')))
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($utilisateur);
            $entityManager->flush();
            // permet de fermer la session utilisateur et d'??viter que l'EntityProvider ne trouve pas la session
            $session = new Session();
            $session->invalidate();
        }

        return $this->redirectToRoute('home');
    }
}
