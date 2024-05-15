<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashbordController extends AbstractController
{
    #[Route('/', name: 'app_dashbord')]
    public function index(): Response
    {
        return $this->render('dashbord.html.twig', [
            'controller_name' => 'DashbordController',
        ]);
    }
}
