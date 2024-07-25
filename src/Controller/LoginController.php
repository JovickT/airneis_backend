<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
class LoginController extends AbstractController
{
    private $jwtEncoder;
    private $tokenExtractor;
    private $jwtManager;
    private $tokenStorage;

    public function __construct(JWTEncoderInterface $jwtEncoder, TokenExtractorInterface $tokenExtractor, JWTTokenManagerInterface $jwtManager, TokenStorageInterface $tokenStorage) {
        $this->jwtEncoder = $jwtEncoder;
        $this->tokenExtractor = $tokenExtractor;
        $this->jwtManager = $jwtManager;
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('api/login_check', name : 'api_login_check',methods: ['POST'])]
    public function loginCheck(AuthenticationUtils $authenticationUtils): JsonResponse
    {
        return $this->json(['message' => 'Registration successful'], 200);
    }

    #[Route('/api/logout', name: 'api_logout', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function logout(): JsonResponse
    {
        // $token = $this->tokenStorage->getToken();

        // if ($token) {
        //     // Invalider le token JWT côté serveur
        //     $this->jwtManager->delete($token);
            
        //     // Effacer le token de la session
        //     $this->tokenStorage->setToken(null);
        // }
        $response = new JsonResponse(['message' => 'Déconnexion réussie']);
        $response->headers->clearCookie('BEARER', '/', null, true, true, 'none');
        
        return $response;
    }

    #[Route('/api/user', name: 'api_user', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function getUserData(Request $request): JsonResponse
    {  
        $user = $this->getUser();
        
        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], 401);
        }

        return new JsonResponse([
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'prenom' => $user->getPrenom(),
            'nom' => $user->getNom(),
            'telephone' => $user->getTelephone(),
            // 'adresse' => $user->getAdresse()
        ]);
    }

    #[Route('/api/check-auth', name: 'check_auth', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function checkAuth(): JsonResponse
    {
        $user = $this->getUser();
        
        return new JsonResponse([
            'status'=>'authentifié',
            'user' => $user->getEmail()
        ]);
    }
}
