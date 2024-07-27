<?php

namespace App\Controller;

use App\Entity\Adresses;
use App\Entity\ImageCarousel;
use App\Repository\CarrouselRepository;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Contact;
use App\Entity\Panier;
use App\Form\RegistrationFormType;
use App\Repository\AdressesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoriesRepository;
use App\Repository\ClientRepository;
use App\Repository\CommandeRepository;
use App\Repository\ImageCarouselRepository;
use App\Repository\ImageProduitRepository;
use App\Repository\ImageRepository;
use App\Repository\MateriauxRepository;
use App\Repository\PanierRepository;
use App\Repository\ProduitsRepository;
use App\Repository\RechercheRepository;
use DateTime;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Constraints\Length;

class ApiController extends AbstractController
{
    private $produitRepository;
    private $categorieRepository;
    private $imageProduitRepository;
    private $imageRepository;
    private $carrouselRepository;
    private $rechercheRepository;
    private $materiauxRepository;
    private $commandeRepository;
    private $clientRepository;
    private $panierRepository;
    private $adresseRepository;


    public function __construct(ProduitsRepository $produitRepository,
    CategoriesRepository $categorieRepository,
    ImageProduitRepository $imageProduitRepository,
    ImageRepository $imageRepository,
    CarrouselRepository $carrouselRepository,
    RechercheRepository $rechercheRepository,
    MateriauxRepository $materiauxRepository,
    CommandeRepository $commandeRepository,
    ClientRepository $clientRepository,
    PanierRepository $panierRepository,
    AdressesRepository $adresseRepository
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
        $this->commandeRepository = $commandeRepository;
        $this->clientRepository = $clientRepository;
        $this->panierRepository = $panierRepository;
        $this->adresseRepository = $adresseRepository;
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

        $allProduit = [];
        foreach ($data as $key => $value) {
            $produit['id'] = $value->getId();
            $produit['reference'] = $value->getReference();
            $produit['nom'] = $value->getNom();
            $produit['prix'] = $value->getPrix();
            $produit['description'] = $value->getDescription();
            $produit['dateCreation'] = $value->getDateCreation();
            $categorie = $value->getCategorie();
            $produit['categorie'] = [
                'id_cat' => $categorie->getIdCategorie(),
                'nom' => $categorie->getNom()
            ];

            $images = $value->getProduitImages();
            foreach ($images as $imageProduit) {
                $image = $imageProduit->getImage();
                if ($image) {
                    $produit['image'] = 'https://localhost:8000/uploads/'.$image->getLien();

                }
            }

            $allProduit[] = $produit;
        }

 
        if (!empty($allProduit)) {
            return $this->json($allProduit, 200, [
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
                $res = $this->imageProduitRepository->findOneBy(["produit" => $value->getId()]);

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

                $images = $value->getProduitImages();
                $imageLinks = [];
                foreach ($images as $imageProduit) {
                    $image = $imageProduit->getImage();
                    if ($image) {
                        $imageLinks[] = 'https://localhost:8000/uploads/'.$image->getLien();
    
                    }
                }
                $tab['images'] = $imageLinks[0];
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

    #[Route('/search', name: 'search_produits', methods: ["POST", "GET"])]
    public function searchProduits(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }
        
        $criteria = [
            "in_stock"=>$data["stock"],
            "price_max"=>$data["maxPrice"],
            "price_min"=>$data["minPrice"],
            "title"=>$data["nameProduct"],
            "material"=>$data["materiaux"],
            "category"=>$data["categories"],

        ];

        $data = $this->rechercheRepository->searchProduits($criteria);

        $table=[];
        $resultat=[];
        foreach ($data as $key => $value) {
            $res = $this->imageProduitRepository->findOneBy(["produit" => $value]);

            $table=["nom" => $value -> getNom(),
            "prix" => $value -> getPrix(),
            "quantite" => $value -> getQuantite(),
            "category" => $value -> getCategorie(),
            // "date_creation " => $value -> getDateCreation()
            'dateCreation' => $value -> getDateCreation()->format('Y-m-d H:i:s')

            ];
            $image = $this->imageRepository->find($res);
            $table['image'][] = 'https://localhost:8000/uploads/'.$image->getLien();

            $resultat[]=$table;

        }

        return $this->json($resultat, 200, [
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

    #[Route('/create-payment-intent', name: 'create_payment_intent', methods: ['POST'])]
    public function createPaymentIntent(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $amount = $data['amount'];

        Stripe::setApiKey('sk_test_VePHdqKTYQjKNInc7u56JBrQ'); // Remplacez par votre clé secrète Stripe

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
            ]);

            return new JsonResponse(['clientSecret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    #[Route('/panier', name: 'app_panier', methods: ['POST','GET'])]
    public function savePanier(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->query->get('test'), true);
        // $data = json_decode($request->query->get('user'), true);
        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        // $repoU = $data['user'] ?? null;

        // if (!isset($repoU['email'])) {
        //     return new JsonResponse(['error' => 'Email non fourni'], 400);
        // }

        $user = $this->clientRepository->find(1);

if (!$user) {
    return new JsonResponse(['error' => 'Utilisateur non authentifié'], 401);
}

$monPanier = $user->getPaniers(); // Récupère tous les paniers de l'utilisateur
$panierEnCours = null;

// Recherchez le panier "en cours"
foreach ($monPanier as $panier) {
    if ($panier->getEtat() === 'en cours') {
        $panierEnCours = $panier;
        break;
    }
}

try {
    $entityManager->beginTransaction();
    date_default_timezone_set('Europe/Paris');
    if ($panierEnCours) {
        // Si un panier "en cours" existe, mettez-le à jour
        $panierEnCours->setLots($data);
        $panierEnCours->setDateModification(new \DateTime());
        // dd($panierEnCours);
    } else {
        // Sinon, créez un nouveau panier
        
        $panier = new Panier();
        $panier->setLots($data);
        $panier->setClient($user);
        $user->addPanier($panier);
        $entityManager->persist($panier);
    }

    $entityManager->persist($user);
    $entityManager->flush();
    $entityManager->commit();

    return new JsonResponse(['success' => $data]);
} catch (\Exception $e) {
    $entityManager->rollback();
    return new JsonResponse(['error' => $e->getMessage()], 500);
}
    }

    #[Route('/commande', name: 'app_commande')]
    public function commande(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        // dd($data);
    
        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }
        $repoL = $data['livraison'];
        $user = $this->clientRepository->find(1);
    
        if (!$user) {
            return new JsonResponse(['error' => 'Utilisateur non authentifié'], 401);
        }

        $rue = $repoL['adresse1'];
        $cp = $repoL['cp'];
        $ville = $repoL['ville'];
        $pays = $repoL['pays'];

    
        $check = $this->adresseRepository->findOneByAddress($rue, $cp, $ville, $pays);

        if(!$check){
            $newAdresse = new Adresses();
            $newAdresse->setRue($rue);
            $newAdresse->setCodePostal($cp);
            $newAdresse->setVille($ville);
            $newAdresse->setPays($pays);
            $entityManager->persist($newAdresse);
            $entityManager->flush();
        }else{
            $newAdresse = $this->adresseRepository->find($check->getId()); 
        }
      

        if(isset($repoL['saveLivraison']) && $repoL['saveLivraison']) {
           
            if (!$check) {
                // Flush here to ensure the address is persisted before use
                $user->addAdresse($newAdresse);
            }
    
            if (isset($repoL['telephone']) && $repoL['telephone']) {
                $user->setTelephone($repoL['telephone']);
            }
    
            $panier = $repoL['panier'];
    
            foreach ($panier as $value) {
                $produit = $this->produitRepository->findOneBy(['nom' => $value['nom']]);
                if ($produit) {
                    $newQuantite = $produit->getQuantite() - $value['quantite'];
                    $produit->setQuantite($newQuantite);
                    $entityManager->persist($produit);
                }
            }
        }
    
        $commande = new Commande();
    
        try {
            $paniers = $user->getPaniers();
            foreach ($paniers as $panier) {
                if ($panier->getEtat() === 'en cours') {
                    $panier->setLots($panier->getLots());
                    $panier->setEtat('terminé');
                    break;
                }
            }
    
            date_default_timezone_set('Europe/Paris');
            $date = new \DateTime();
            $reference = $this->commandeRepository->generateRandomReference();
            $commande->setClient($user);
            $commande->setReference($reference);
            $commande->setPanier($panier);
            $commande->setDateCommande($date);
    
            if (isset($newAdresse)) {
                $commande->setAdresse($newAdresse);
            }
    
            $entityManager->persist($commande);
            $entityManager->persist($user);
            $entityManager->flush();
    
            $orderDetails = [
                'client' => $user->getIdClient(),
                'reference' => $commande->getReference(),
                'panier' => $commande->getPanier()->getIdPanier(),
                'date_commande' => $commande->getDateCommande()->format('Y-m-d H:i:s'),
            ];
    
            return new JsonResponse(['success' => 'Commande enregistrée avec succès', 'commande' => $orderDetails]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
    
    

    #[Route('/mesCommandes', name: 'app_mes_commandes')]
    public function mesCommande(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $this->clientRepository->find(1);
    
        if (!$user) {
            return new JsonResponse(['error' => 'Utilisateur non authentifié'], 401);
        }
    
        $commandes = $this->commandeRepository->findBy(['client' => $user], ['date_commande' => 'DESC']);
        $commandesDetails = [];
    
        if (isset($commandes) && $commandes) {
            $prix = 0;
            foreach ($commandes as $commande) {
                $panier = $commande->getPanier();
                $panierLots = $panier->getLots();
                foreach ($panierLots as $lots) {
                    $prix += $lots['prix'];
                }
                $adresseCommande = $commande->getAdresse();
                if ($adresseCommande !== null) {
                    $adresse = [
                        'nom' => $user->getNom(),
                        'prenom' => $user->getPrenom(),
                        'rue' => $adresseCommande->getRue() ?? '',
                        'cp' => $adresseCommande->getCodePostal() ?? '',
                        'ville' => $adresseCommande->getVille() ?? '',
                        'pays' => $adresseCommande->getPays() ?? '',
                        'telephone' => $user->getTelephone()
                    ];
                } else {
                    $adresse = [
                        'rue' => '',
                        'cp' => '',
                        'ville' => '',
                        'pays' => '',
                    ];
                }
                $commandesDetails[] = [
                    'reference' => $commande->getReference(),
                    'date_commande' => $commande->getDateCommande()->format('Y-m-d'),
                    'nb_articles' => count($panierLots),
                    'panier' => $panierLots,
                    'adresse' => $adresse,
                    'ttc' => $prix,
                    'tva' => $prix * 0.2,
                    'etat' => $commande->getEtat() 
                ];  
                $prix = 0;
            }
        }
    
        return new JsonResponse(['success' => $commandesDetails]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function messages(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {

        $data = json_decode($request->getContent(), true);
    
        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        $contact = new Contact();
        $contact->setNom($data['nom']);
        $contact->setPrenom($data['prenom']);
        $contact->setEmail($data['email']);
        $contact->setMessage($data['message']);

        $entityManager->persist($contact);
        $entityManager->flush();

        return new JsonResponse(['success' => 'Message envoyé avec succès']);

    }
    
}
