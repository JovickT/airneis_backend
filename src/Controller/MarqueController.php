<?php

namespace App\Controller;

use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MarqueController extends AbstractController
{

    private $marqueRepository;

    public function __construct(MarquesRepository $marqueRepository) {
        $this->marqueRepository = $marqueRepository;
    }

    #[Route('/marque', name: 'app_marque')]
    public function index(): Response
    {
        return $this->render('marque.html.twig', [
            'controller_name' => 'MarqueController',
            'marques' => $this->displayProduit(),
            'tableHedears' => ['Nom']
        ]);
    }

    public function displayProduit(){
        $marques = $this->marqueRepository->getMarques();

        return $marques;
    }
}
