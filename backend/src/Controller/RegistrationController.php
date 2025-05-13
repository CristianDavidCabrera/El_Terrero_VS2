<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            //Por defecto van a ser todos con roles de usuario
            $user-> setRoles(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/register/success', name: 'app_register_success')]
    public function registerSuccess (TokenStorageInterface $tokenStorage, SessionInterface $session) {

        $user = $this->getUser();

       if ($this->isGranted('ROLE_ADMIN')) {
            // El usuario tiene el rol ROLE_ADMIN
            return $this->render('dashboardAdmin.html.twig', [
                'user' => $user
               ]);
        } else if ($this->isGranted('ROLE_USER')){
            /// El usuario tiene el rol ROLE_USER
            return $this->render('dashboardUser.html.twig', [
                'user' => $user
               ]);
        } else {
              // Cerrar sesión
            $tokenStorage->setToken(null); // Esto elimina el token del usuario
            $session->invalidate(); // Esto invalida la sesión actual
            return $this->render('home.html.twig', [
                'user' => $user
               ]);
        } 
    } 


}
