<?php

namespace App\Controller;

use App\Entity\ImageCarousel;
use App\Repository\CarrouselRepository;
use App\Repository\CategoriesRepository;
use App\Repository\ImageCarouselRepository;
use App\Repository\ImageProduitRepository;
use App\Repository\ImageRepository;
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
    private $imageProduitRepository;
    private $imageRepository;
    private $carrouselRepository;

    public function __construct(ProduitsRepository $produitRepository,
    CategoriesRepository $categorieRepository,ImageProduitRepository $imageProduitRepository,
    ImageRepository $imageRepository, CarrouselRepository $carrouselRepository,
     ) {
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
        $this->imageProduitRepository = $imageProduitRepository;
        $this->imageRepository = $imageRepository;
        $this->carrouselRepository = $carrouselRepository;
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
            $myArray["theProduct"] = $data["theProduct"];
           
           foreach ($data["similary"] as $key => $value) {
                $res = $this->imageProduitRepository->findOneBy(["id_produit" => $value->getId()]);

                $tab['id'] =  $value->getId();
                $tab['reference'] =  $value->getReference();
                $tab['nom'] =  $value->getNom();
                $tab['prix'] =  $value->getPrix();
                $tab['description'] =  $value->getDescription();
                $tab['quantite'] =  $value->getQuantite();
                $tab['dateCreation'] =  $value->getDateCreation();
                $tab['marque'] =  $value->getMarque();
                $tab['categorie'] =  $value->getCategorie();
                $tab['materiaux'] =  $value->getMateriaux();

                $image = $res->getIdImage();
                $tab['image'] = 'https://localhost:8000/uploads/'.$image->getLien();
                $myArray["similary"][] = $tab;
           }

           return $this->json($myArray, 200, [
               'Access-Control-Allow-Origin' => '*'
           ]);
       }

        return $this->json(['error' => 'Category not specified'], 400, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }

    #[Route('/ip', name: 'image_product')]
    public function imageofProduct(Request $request): JsonResponse
    {
      
        $imageProduits = $this -> imageProduitRepository->findAll();

       if ($imageProduits) {

            $data = [];

            foreach ($imageProduits as $imageProduit) {
                $produitNom = $imageProduit->getIdProduit()->getNom();
              $imageLien = $this->getParameter('app.url') . '/uploads/' . $imageProduit->getIdImage()->getLien();
        
                // Vérifier si le produit existe déjà dans le tableau data
                if (!isset($data[$produitNom])) {
                    $data[$produitNom] = [
                        'produit' => $produitNom,
                        'images' => []
                    ];
                }
        
                // Ajouter le lien de l'image au produit correspondant
                $data[$produitNom]['images'][] = $imageLien;
            }
    
        // Réindexer le tableau pour s'assurer qu'il est bien formaté en JSON
            $data = array_values($data);
            

           return $this->json($data, 200, [
               'Access-Control-Allow-Origin' => '*'
           ]);
       }

        return $this->json(['error' => 'Category not specified'], 400, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }

    // #[Route('/carrousel', name: 'image_carrousel')]
    // public function imagesCarrousel(Request $request): JsonResponse
    // {

     

    //    if ($imageCarrousel) {

    //         $data = [];

    //         foreach ($imageProduits as $imageProduit) {
    //             $produitNom = $imageProduit->getIdProduit()->getNom();
    //           $imageLien = $this->getParameter('app.url') . '/uploads/' . $imageProduit->getIdImage()->getLien();
        
    //             // Vérifier si le produit existe déjà dans le tableau data
    //             if (!isset($data[$produitNom])) {
    //                 $data[$produitNom] = [
    //                     'produit' => $produitNom,
    //                     'images' => []
    //                 ];
    //             }
        
    //             // Ajouter le lien de l'image au produit correspondant
    //             $data[$produitNom]['images'][] = $imageLien;
    //         }
    
    //     // Réindexer le tableau pour s'assurer qu'il est bien formaté en JSON
    //         $data = array_values($data);
            

    //        return $this->json($data, 200, [
    //            'Access-Control-Allow-Origin' => '*'
    //        ]);
    //    }

    //     return $this->json(['error' => 'Category not specified'], 400, [
    //         'Access-Control-Allow-Origin' => '*'
    //     ]);
    // }
}
