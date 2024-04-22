<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    private $produitRepository;

    public function __construct(ProduitsRepository $produitRepository) {
        $this->produitRepository = $produitRepository;
    }

    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit.html.twig', [
            'controller_name' => 'ProduitController',
            'produits' => $this->displayProduit(),
            'tableHedears' => ['Référence','Nom','Prix €','Description','Quantité','Date de création','Marque','Catégorie']
        ]);
    }

    public function displayProduit(){
        $produits = $this->produitRepository->getProduits();

        return $produits;
    }
}
