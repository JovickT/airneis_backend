<?php

namespace App\Controller;

use App\Repository\MateriauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MaterielController extends AbstractController
{

    private $materielRepository;

    public function __construct(MateriauxRepository $materielRepository) {
        $this->materielRepository = $materielRepository;
    }

    #[Route('/materiel', name: 'app_materiel')]
    public function index(): Response
    {
        return $this->render('materiel.html.twig', [
            'controller_name' => 'MaterielController',
            'materiaux' => $this->displayMateriel(),
            'tableHedears' => ['Nom']
        ]);
    }

    public function displayMateriel(){
        $materiaux = $this->materielRepository->getMateriaux();

        return $materiaux;
    }
}
