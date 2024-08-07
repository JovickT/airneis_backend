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
use Stripe\Customer;
use Stripe\PaymentIntent;
use App\Entity\PaymentMethod;
use App\Repository\PaymentMethodRepository;
use Stripe\Stripe;
use Stripe\PaymentMethod as StripePaymentMethod;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


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
    private $paymentMethodRepository;


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
    AdressesRepository $adresseRepository,
    PaymentMethodRepository $paymentMethodRepository
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
        $this->paymentMethodRepository = $paymentMethodRepository;
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

    #[Route('/api/filtre', name: 'filtre_data')]
    public function filtre(): JsonResponse
    {
        // Logique pour récupérer les données et les renvoyer
        $data['Materiaux'] =  $this->materiauxRepository->findAll();  // Données à renvoyer
        $data['Catégorie'] =  $this->categorieRepository->findAll();  // Données à renvoyer
        return $this->json($data , 200, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }

    #[Route('/api/categories', name: 'ProductOfCategorie_data')]
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

    #[Route('/api/produits', name: 'Product_data')]
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
                foreach ($images as $imageProduit) {
                    $image = $imageProduit->getImage();
                    if ($image) {
                        $imageLinks= 'https://localhost:8000/uploads/'.$image->getLien();
    
                    }
                }
                $tab['images'] = $imageLinks;
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

    #[Route('/api/search', name: 'search_produits', methods: ["POST", "GET"])]
    public function searchProduits(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
    
        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }
    
        $criteria = [
            "in_stock" => $data["stock"],
            "price_max" => $data["maxPrice"],
            "price_min" => $data["minPrice"],
            "title" => $data["nameProduct"],
            "material" => $data["materiaux"],
            "category" => $data["categories"],
        ];
    
        $products = $this->rechercheRepository->searchProduits($criteria);
    
        $resultat = [];
        foreach ($products as $product) {
            $imageProduit = $this->imageProduitRepository->findOneBy(["produit" => $product]);
    
            if ($imageProduit) {
                $image = $this->imageRepository->find($imageProduit->getImage()->getIdImage());
    
                if ($image) {
                    $resultat[] = [
                        "nom" => $product->getNom(),
                        "prix" => $product->getPrix(),
                        "quantite" => $product->getQuantite(),
                        "category" => $product->getCategorie(),
                        "dateCreation" => $product->getDateCreation()->format('Y-m-d H:i:s'),
                        'image' => 'https://localhost:8000/uploads/' . $image->getLien(),
                    ];
                }
            }
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
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $client = new Client();
        $form = $this->createForm(RegistrationFormType::class, $client);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe
            $hashedPassword = $passwordHasher->hashPassword(
                $client,
                $form->get('plainPassword')->getData()
            );
            $client->setPassword($hashedPassword);

            // Définir les rôles (par exemple, ROLE_USER)
            $client->setRoles(['ROLE_USER']);

            $entityManager->persist($client);
            $entityManager->flush();

            return $this->json(['message' => 'Registration successful'], JsonResponse::HTTP_CREATED);
        }

        // Collecter les erreurs de validation
        $errors = [];
        foreach ($form->getErrors(true) as $error) {
            $errors[] = $error->getMessage();
        }

        return $this->json(['errors' => $errors], JsonResponse::HTTP_BAD_REQUEST);
    }

    #[Route('/api/create-payment-intent', name: 'create_payment_intent', methods: ['POST'])]
    public function createPaymentIntent(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $amount = $data['amount'];

        Stripe::setApiKey($_ENV['STRIPE_API_KEY']);// Remplacez par votre clé secrète Stripe

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

    #[Route('/api/attach-payment-method', name: 'attach_payment_method')]
    public function attachPaymentMethod(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        \Stripe\Stripe::setApiKey('sk_test_VePHdqKTYQjKNInc7u56JBrQ'); // Remplacez par votre clé secrète Stripe

        $data = json_decode($request->getContent(), true);

        if (is_null($data) || !isset($data['paymentMethodId'], $data['user'])) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        $paymentMethodId = $data['paymentMethodId']['id'];
        $paymentMethodBrand = $data['paymentMethodId']['card']['brand'];
        $paymentMethodLast4 = $data['paymentMethodId']['card']['last4'];
        $paymentMethodExpMonth = $data['paymentMethodId']['card']['exp_month'];
        $paymentMethodExpYear = $data['paymentMethodId']['card']['exp_year'];
        $clientData = $data['user'];

        $user = $this->clientRepository->findOneBy(['email' => $clientData['email']]);

        if (is_null($user)) {
            return new JsonResponse(['error' => 'Utilisateur inconnu'], 400);
        }

        // Récupérer ou créer le client Stripe
        $stripeCustomerId = $user->getStripeCustomerId();
        if ($stripeCustomerId) {
            $customer = Customer::retrieve($stripeCustomerId);
        } else {
            $customer = Customer::create([
                'email' => $user->getEmail(),
            ]);
            $user->setStripeCustomerId($customer->id);
            $entityManager->persist($user);
            $entityManager->flush();
        }

        try {
            // Créer une nouvelle méthode de paiement Stripe basée sur les informations existantes
            $paymentMethod = StripePaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'number' => '4242424242424242', // Numéro de carte de test
                    'exp_month' => $paymentMethodExpMonth,
                    'exp_year' => $paymentMethodExpYear,
                    'cvc' => '123', // Code de sécurité de test
                ],
            ]);

            // Attacher la nouvelle méthode de paiement au client
            $paymentMethod->attach(['customer' => $customer->id]);

            // Ajouter la méthode de paiement à l'utilisateur dans la base de données
            $paymentMethodEntity = new PaymentMethod();
            $paymentMethodEntity->setStripePaymentMethodId($paymentMethod->id);
            $paymentMethodEntity->setLast4($paymentMethodLast4);
            $paymentMethodEntity->setBrand($paymentMethodBrand);
            $paymentMethodEntity->setExpMonth($paymentMethodExpMonth);
            $paymentMethodEntity->setExpYear($paymentMethodExpYear);
            $paymentMethodEntity->setEtat(true);
            $paymentMethodEntity->setClient($user);
            $entityManager->persist($paymentMethodEntity);
            $entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }

        return new JsonResponse(['success' => true]);
    }

    #[Route('/api/get-payment-methods', name: 'get_payment_methods')]
    public function getPaymentMethods(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        $email = $data['email']; // Décoder la chaîne JSON en tableau associatif
        
        $user = $this->clientRepository->findOneBy(['email' => $email]);

        if (is_null($user)) {
            return new JsonResponse(['error' => 'utilisateur inconnu'], 400);
        }

        $paymentMethods = $user->getPaymentMethods();
        $methods = [];

        foreach ($paymentMethods as $paymentMethod) {
            if($paymentMethod->getEtat() == true){
                $methods[] = [
                    'id' => $paymentMethod->getStripePaymentMethodId(),
                    'last4' => $paymentMethod->getLast4(),
                    'exp_month' => $paymentMethod->getExpMonth(),
                    'exp_year' => $paymentMethod->getExpYear(),
                    'brand' => $paymentMethod->getBrand(),
                ];
            }
        }
        return new JsonResponse(['paymentMethods' => $methods]);
    }
    #[Route('/api/panier', name: 'app_panier', methods: ['POST','GET'])]
    public function savePanier(Request $request, EntityManagerInterface $entityManager, Security $security): JsonResponse
    {
        $data = json_decode($request->query->get('test'), true);
        $user = json_decode($request->query->get('user'), true);
        

        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        // $repoU = $data['user'] ?? null;

        if (is_null($user)) {
            return new JsonResponse(['error' => 'Email non fourni'], 400);
        }

        $email = $user['email'];

        $client = $this->clientRepository->findOneBy(['email' => $email]);

        if (!$client) {
            return new JsonResponse(['error' => 'Utilisateur non authentifié'], 401);
        }

        $monPanier = $client->getPaniers(); // Récupère tous les paniers de l'utilisateur
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
                $panier->setClient($client);
                $client->addPanier($panier);
                $entityManager->persist($panier);
            }

            $entityManager->persist($client);
            $entityManager->flush();
            $entityManager->commit();

            return new JsonResponse(['success' => $data]);
        } catch (\Exception $e) {
            $entityManager->rollback();
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    #[Route('/api/majPanier', name: 'app_maj_panier', methods: ['POST'])]
public function majPanier(Request $request, EntityManagerInterface $entityManager, PanierRepository $panierRepository, ClientRepository $clientRepository): JsonResponse
{
        $data = json_decode($request->getContent(), true);
        
        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        // Récupérer les informations utilisateur et panier depuis la requête
        $user = $data['user'];
        $panierActuel = $data['panier'];

        // Rechercher le client en base de données
        $client = $clientRepository->findOneBy(['email' => $user['email']]);
        if (!$client) {
            return new JsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }


        // Récupérer le panier en cours de l'utilisateur
        $panierEnCours = $panierRepository->findOneBy(['client' => $client, 'etat' => 'en cours']);
        if($panierEnCours === []){
            return new JsonResponse($this->convertPanierToArray($panierActuel), 200);
        }

        if ($panierEnCours) {
            $lotsEnCours = $panierEnCours->getLots();
            
            // Créer une map (tableau associatif) pour les lots en cours
            $lotsMap = [];
            foreach ($lotsEnCours as $lot) {
                $lotsMap[$lot['id']] = $lot;
            }

            // Mettre à jour ou ajouter les lots du panier actuel
            foreach ($panierActuel as $lotActuel) {
                if (isset($lotsMap[$lotActuel['id']])) {
                    // Si le lot existe déjà, mettre à jour sa quantité
                    $lotsMap[$lotActuel['id']]['quantite'] = $lotActuel['quantite'];
                } else {
                    // Sinon, ajouter le lot au panier
                    $lotsEnCours[] = $lotActuel;
                }
            }

            $panierEnCours->setLots($lotsEnCours);
            $panierEnCours->setDateModification(new \DateTime());

            $entityManager->persist($panierEnCours);
            $entityManager->flush();

            $responsePanier = $this->convertPanierToArray($panierEnCours);
        } else {
            // Si l'utilisateur n'a pas de panier en cours, créer un nouveau panier
            $responsePanier = $panierActuel;
        }

        return new JsonResponse($responsePanier, 200);
    }

    /**
     * Convertit un objet Panier en tableau associatif
     */
    private function convertPanierToArray(Panier $panier): array
    {
        $lots = $panier->getLots();
        $result = [];
    
        foreach ($lots as $lot) {
            $result[] = [
                'id' => $lot['id'] ?? null,
                'nom' => $lot['nom'] ?? null,
                'prix' => $lot['prix'] ?? null,
                'quantite' => $lot['quantite'] ?? null,
                'categorie' => $lot['categorie'] ?? null,
                'description' => $lot['description'] ?? null,
                'image' => $lot['image'] ?? null,
            ];
        }
    
        return $result;
    }
    

    #[Route('/api/get-payment-methods-commande', name: 'app_get_payment_methods_commande', methods: ['POST'])]
    public function getPayementCommande(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $reference = $data['reference'];

        $commande = $this->commandeRepository->findOneBy(['reference' => $reference]);

        $idCommande = $commande->getPaymentMethod();

        $find = $this->paymentMethodRepository->findOneBy(['id' => $idCommande->getId()]);
        $resultat = [
            "id" => $find->getStripePaymentMethodId(),
            "brand" => $find->getBrand(),
            "last4" => $find->getLast4(),
            "exp_month" => $find->getExpMonth(),
            "exp_year" => $find->getExpYear()
        ];

        try {
            return new JsonResponse($resultat);
        }catch (\Exception $e) {
            return new JsonResponse (['error' => $e ->getMessage()], 400);
        }
    }

    #[Route('/api/commande', name: 'app_commande')]
    public function commande(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Définir la clé API Stripe
        Stripe::setApiKey($_ENV['STRIPE_API_KEY']);
        
        $data = json_decode($request->getContent(), true);
        
        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }
    
        $livraisonData = $data['livraison'] ?? null;
        $userData = $data['user'] ?? null;
        $paymentData = $data['paiement'] ?? null;
    
        if (!$livraisonData || !$userData || !$paymentData) {
            return new JsonResponse(['error' => 'Données de livraison, utilisateur ou paiement manquantes'], 400);
        }
    
        $user = $this->clientRepository->findOneBy(['email' => $userData['email']]);
    
        if (!$user) {
            return new JsonResponse(['error' => 'Utilisateur non authentifié'], 401);
        }
    
        // Gestion de l'adresse
        $rue = $livraisonData['adresse1'];
        $cp = $livraisonData['cp'];
        $ville = $livraisonData['ville'];
        $pays = $livraisonData['pays'];
    
        $adresse = $this->adresseRepository->findOneByAddress($rue, $cp, $ville, $pays);
    
        if (!$adresse) {
            $adresse = new Adresses();
            $adresse->setRue($rue);
            $adresse->setCodePostal($cp);
            $adresse->setVille($ville);
            $adresse->setPays($pays);
            $entityManager->persist($adresse);
            $entityManager->flush();
        }
    
        if ($livraisonData['saveLivraison'] ?? false) {
            $user->addAdresse($adresse);
    
            if ($livraisonData['telephone'] ?? false) {
                $user->setTelephone($livraisonData['telephone']);
            }
        }
    
        // Gestion de la méthode de paiement
        $paymentMethodId = $paymentData['id'];
        $paymentMethod = $this->paymentMethodRepository->findOneBy(['stripePaymentMethodId' => $paymentMethodId]);
    
        if (!$paymentMethod) {
            try {
                $stripePaymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);
    
                $paymentMethod = new PaymentMethod();
                $paymentMethod->setStripePaymentMethodId($stripePaymentMethod->id);
                $paymentMethod->setLast4($stripePaymentMethod->card->last4);
                $paymentMethod->setBrand($stripePaymentMethod->card->brand);
                $paymentMethod->setExpMonth($stripePaymentMethod->card->exp_month);
                $paymentMethod->setExpYear($stripePaymentMethod->card->exp_year);
                $paymentMethod->setClient($user);
    
                $entityManager->persist($paymentMethod);
                $entityManager->flush();
            } catch (\Exception $e) {
                return new JsonResponse(['error' => 'Erreur lors de la création de la méthode de paiement : ' . $e->getMessage()], 500);
            }
        }
    
        // Mise à jour du panier et des produits
        foreach ($data['livraison']['panier'] as $item) {
            $produit = $this->produitRepository->findOneBy(['nom' => $item['nom']]);
            if ($produit) {
                $newQuantite = $produit->getQuantite() - $item['quantite'];
                $produit->setQuantite($newQuantite);
                $entityManager->persist($produit);
            }
        }
    
        // Création de la commande
        try {
            $panier = $user->getPaniers()->filter(fn($p) => $p->getEtat() === 'en cours')->first();
            if ($panier) {
                $panier->setLots($panier->getLots());
                $panier->setEtat('terminé');
            }
    
            $commande = new Commande();
            $commande->setClient($user);
            $commande->setReference($this->commandeRepository->generateRandomReference());
            $commande->setPanier($panier);
            $commande->setDateCommande(new \DateTime('now', new \DateTimeZone('Europe/Paris')));
            $commande->setAdresse($adresse);
            $commande->setPaymentMethod($paymentMethod);
    
            $entityManager->persist($commande);
            $entityManager->persist($user);
            $entityManager->flush();
    
            $orderDetails = [
                'client' => $user->getIdClient(),
                'reference' => $commande->getReference(),
                'panier' => $commande->getPanier()->getIdPanier(),
                'paiement' => [
                    'brand' => $paymentMethod->getBrand(),
                    'last4' => $paymentMethod->getLast4(),
                    'exp_month' => $paymentMethod->getExpMonth(),
                    'exp_year' => $paymentMethod->getExpYear(),
                ],
                'date_commande' => $commande->getDateCommande()->format('Y-m-d H:i:s'),
            ];
    
            return new JsonResponse(['success' => 'Commande enregistrée avec succès', 'commande' => $orderDetails]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur lors de la création de la commande : ' . $e->getMessage()], 500);
        }
    }
    

    #[Route('/api/mesCommandes', name: 'app_mes_commandes')]
    public function mesCommande(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        // dd($data);
    
        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        $email = $data['email'];

        $user = $this->clientRepository->findOneBy(['email' => $email]);
    
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
                    $prix += $lots['prix']*$lots['quantite'];
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

    #[Route('/api/contact', name: 'app_contact')]
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

    #[Route('/api/forgotPassword', name: 'app_forgotPassword', methods: ['POST'])]
    public function forgotPassword(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        $user = $this->clientRepository->findOneBy(['email' => $data['email']]);

        if (!$user) {
            return new JsonResponse(['error' => 'Utilisateur non authentifié'], 401);
        }

        $newPassword = $this->clientRepository->generatePassword();
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $email = (new Email())
            ->from('contact@airneis.com')
            ->to($user->getEmail())
            ->subject('Réinitialisation de votre mot de passe')
            ->text('Votre nouveau mot de passe est : ' . $newPassword);

        try {
            $user->setPassword($passwordHash);
            $entityManager->persist($user);
            $entityManager->flush();
            $mailer->send($email);
            return new JsonResponse(['success' => 'Email envoyé avec succès'], 200);
        } catch (TransportExceptionInterface $e) {
            return new JsonResponse(['error' => 'Échec de l\'envoi de l\'email'], 500);
        }
    }

    #[Route('/api/userAdresses', name: 'app_userAdresses', methods: ['POST'])]
    public function userAdresses(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // dd($data);
        if (is_null($data)) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }
        
        // dd($data);
        if( isset($data['email']) && $data['email']){
            $user = $this->clientRepository->findOneBy(['email' => $data['email']]);
        }


        if (!$user) {
            return new JsonResponse(['error' => 'Utilisateur non authentifié'], 401);
        }


        $adresses = $user->getAdresses();
        $adressesClient = [];
        foreach ($adresses as $key => $adresse) {
            $adressesClient[] = [
                'rue' => $adresse->getRue(),
                'ville' => $adresse->getVille(),
                'cp' => $adresse->getCodePostal(),
                'pays' => $adresse->getPays()
            ];

        }



        return new JsonResponse($adressesClient, 200);


    }

    
}
