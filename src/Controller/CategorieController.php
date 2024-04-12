<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategorieController extends AbstractController
{
    private $categorieRepository;

    public function __construct(CategoriesRepository $categorieRepository) {
        $this->categorieRepository = $categorieRepository;
    }

    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie.html.twig', [
            'controller_name' => 'CategorieController',
            'categories' => $this->displaycategorie(),
            'tableHedears' => ['Nom']
        ]);
    }

    public function displaycategorie(){
        $categorie = $this->categorieRepository->getCategories();

        return $categorie;
    }
}
