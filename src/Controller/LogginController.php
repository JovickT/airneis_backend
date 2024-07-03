<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Entity\Client;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class LogginController extends AbstractController
{
    #[Route('/', name: 'app_loggin')]
    public function index(#[CurrentUser] ?Client $user, JWTTokenManagerInterface $jwtManager): Response
    {
        return $this->render('loggin/index.html.twig', [
           'controller_name' => 'LogginController',
        ]);
    }
}
