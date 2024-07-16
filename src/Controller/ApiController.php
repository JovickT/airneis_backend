<?php

namespace App\Controller;

use App\Entity\ImageCarousel;
use App\Repository\CarrouselRepository;
use App\Entity\Client;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoriesRepository;
use App\Repository\ImageCarouselRepository;
use App\Repository\ImageProduitRepository;
use App\Repository\ImageRepository;
use App\Repository\MateriauxRepository;
use App\Repository\ProduitsRepository;
use App\Repository\RechercheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;


class ApiController extends AbstractController
{
    private $produitRepository;
    private $categorieRepository;
    private $imageProduitRepository;
    private $imageRepository;
    private $carrouselRepository;
    private $rechercheRepository;
    private $materiauxRepository;


    public function __construct(ProduitsRepository $produitRepository,
    CategoriesRepository $categorieRepository,ImageProduitRepository $imageProduitRepository,
    ImageRepository $imageRepository, CarrouselRepository $carrouselRepository,RechercheRepository $rechercheRepository,
    MateriauxRepository $materiauxRepository
     ) {
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
        $this->imageProduitRepository = $imageProduitRepository;
        $this->imageRepository = $imageRepository;
        $this->carrouselRepository = $carrouselRepository;
        $this->produitRepository = $produitRepository;
        $this->produitRepository = $produitRepository;
        $this->rechercheRepository = $rechercheRepository;
        $this->materiauxRepository = $materiauxRepository;
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

    #[Route('/filtre', name: 'filtre_data')]
    public function filtre(): JsonResponse
    {
        // Logique pour récupérer les données et les renvoyer
        $data['Materiaux'] =  $this->materiauxRepository->findAll();  // Données à renvoyer
        $data['Catégorie'] =  $this->categorieRepository->findAll();  // Données à renvoyer
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
        $data = $this->produitRepository->findProductsByCategoryName($prodofCat);
 
        if (!empty($data)) {
            return $this->json($data, 200, [
                'Access-Control-Allow-Origin' => '*'
            ]);
        } else {
            return $this->json(['error' => 'Category not found'], 404, [
                'Access-Control-Allow-Origin' => '*'
            ]);
        }
    }

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

           if(!(empty($myArray["theProduct"]) || empty($myArray["similary"]))){
                return $this->json($myArray, 200, [
                    'Access-Control-Allow-Origin' => '*'
                ]);
           }else{
                return $this->json(['error' => 'Category not found'], 404, [
                    'Access-Control-Allow-Origin' => '*'
                ]);
           }
          
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


    // #[Route('/search', name: 'search_produits')]
    // public function searchProduits(Request $request): JsonResponse
    // {
    //     $keyword = $request->query->get('keyword');

    //     if ($keyword) {
    //         $data = $this->rechercheRepository->searchProduitsByKeyword($keyword);
    //         return $this->json($data, 200, [
    //             'Access-Control-Allow-Origin' => '*'
    //         ]);
    //     }

    //     return $this->json(['error' => 'Keyword not specified'], 400, [
    //         'Access-Control-Allow-Origin' => '*'
    //     ]);
    // }

    #[Route('/search', name: 'search_produits')]
    public function searchProduits(Request $request): JsonResponse
    {
        $criteria = [
            'title' => $request->query->get('title'),
            'description' => $request->query->get('description'),
            'material' => $request->query->get('material'),
            'price_min' => $request->query->get('price_min'),
            'price_max' => $request->query->get('price_max'),
            'category' => $request->query->get('category'),
            'in_stock' => $request->query->get('in_stock'),
            'sort_by' => $request->query->get('sort_by'),
            'sort_order' => $request->query->get('sort_order'),
        ];

        $data = $this->rechercheRepository->searchProduits($criteria);

        return $this->json($data, 200, [
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


    
    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $client = new Client();
        $form = $this->createForm(RegistrationFormType::class, $client);
        $form->submit($data);

        if ($form->isValid()) {
            // Encode the plain password
            $client->setPassword(
                $userPasswordHasher->hashPassword(
                    $client,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($client);
            $entityManager->flush();

            return $this->json([
                'message' => 'User registered successfully'
            ], Response::HTTP_CREATED);
        }

        return $this->json($form->getErrors(true, false), Response::HTTP_BAD_REQUEST);
    }
       
    #[Route('/api/csrf-token', name: 'api_csrf_token', methods: ['GET'])]
    public function getCsrfToken(CsrfTokenManagerInterface $csrfTokenManager): JsonResponse
    {
        $token = $csrfTokenManager->getToken('authenticate')->getValue();
        return new JsonResponse(['token' => $token]);
    }
}
