<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\FormProduitType;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'title' => 'Liste de Produits',
            'produits' => $this->displayProduit(),
            'tableHedears' => ['Référence','Nom','Prix €','Description','Quantité','Date de création','Marque','Catégorie']
        ]);
    }

    public function displayProduit(){
        $produits = $this->produitRepository->getProduits();

        return $produits;
    }

    #[Route('/addProduct', name: 'app_form_produit')]
    public function displayAddForm(Request $request) : Response{

        $produit = new Produits();
        $form = $this->createForm(FormProduitType::class, $produit);
        $form->handleRequest($request);
    
        return $this->render('forms/formProduit.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouveau Produit',
            'form' => $form->createView(),
        ]);
    }

    public function callFormAddProduit(){
        $produit = new Produits();
        return $this->createForm(FormProduitType::class, $produit);
    }
}
