<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    private $produitRepository;
    private $categorieRepository;

    public function __construct(ProduitsRepository $produitRepository,CategoriesRepository $categorieRepository) {
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
    }

    #[Route('/api/data', name: 'frontend_data')]
    public function fetchData(): JsonResponse
    {
        // Logique pour récupérer les données et les renvoyer
        $data['produit'] =  $this->produitRepository->getProduits();  // Données à renvoyer
        $data['categorie'] =  $this->categorieRepository->getCategories();  // Données à renvoyer
        return $this->json($data , 200, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
}
