<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\RegistrationFormType;
use App\Repository\UtilisateursRepository;
use App\Security\UtilisateursAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(UtilisateursRepository $userRopo, Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UtilisateursAuthenticator $authenticator): Response
    {

        //Permet d'ajouter l'utilisateurs sur la base de donées
        $Utilisateurs = new Utilisateurs();

        //Formulaire d'inscription
        $form = $this->createForm(RegistrationFormType::class, $Utilisateurs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $Utilisateurs->setMotDePasse(
                $passwordEncoder->encodePassword(
                    $Utilisateurs,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Utilisateurs);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $Utilisateurs,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('inscription/index.html.twig', [
            'FormulaireDInscription' => $form->createView(),
        ]);
    }
}
