<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/data', name: 'frontend_data')]
    public function fetchData(): JsonResponse
    {
        // Logique pour récupérer les données et les renvoyer
        $data['produit'] =  $this->produitRepository->getProduits();  // Données à renvoyer
        $data['categorie'] =  $this->categorieRepository->getCategories();  // Données à renvoyer
        return $this->json($data , 200, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }

    #[Route('/categories', name: 'ProductOfCategorie_data')]
    public function ProductOfCategorie(Request $request): JsonResponse
    {
       // Récupérer le paramètre de requête
       $prodofCat = $request->query->get('prodofCat');

       if ($prodofCat) {
           // Récupérer les produits de la catégorie
           $data = $this->produitRepository->findProductsByCategoryName($prodofCat);

           return $this->json($data, 200, [
               'Access-Control-Allow-Origin' => '*'
           ]);
       }

        return $this->json(['error' => 'Category not specified'], 400, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }

    #[Route('/produits', name: 'Product_data')]
    public function ProductData(Request $request): JsonResponse
    {
       // Récupérer le paramètre de requête
       $produits = $request->query->get('produits');
       $categories = $request->query->get('categories');

       if ($produits) {
           // Récupérer les produits de la catégorie
           $data["theProduct"] = $this->produitRepository->findProductsByName($produits);
           $data["similary"] = $this->produitRepository->findProductsByCategoryName($categories);

           return $this->json($data, 200, [
               'Access-Control-Allow-Origin' => '*'
           ]);
       }

        return $this->json(['error' => 'Category not specified'], 400, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
}
