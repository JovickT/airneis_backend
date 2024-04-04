<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LogginController extends AbstractController
{
    #[Route('/home', name: 'app_loggin')]
    public function index(): Response
    {
        return $this->render('loggin/index.html.twig', [
            'controller_name' => 'LogginController',
        ]);
    }
}
