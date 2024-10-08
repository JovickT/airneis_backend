<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            // Vérifiez si l'utilisateur a le rôle ADMIN
            if (!$this->isGranted('ROLE_ADMIN')) {
                // Déconnectez l'utilisateur s'il n'est pas admin
                $this->container->get('security.token_storage')->setToken(null);
                $this->container->get('session')->invalidate();
                throw new AccessDeniedException('Accès réservé aux administrateurs.');
            }
            return $this->redirectToRoute('app_dashbord');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('loggin/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/', name: 'app_index')]
    public function original(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->login($authenticationUtils);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
