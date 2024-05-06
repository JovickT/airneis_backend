<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\FormProduitType;
use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    private $produitRepository;
    private $categorieRepository;

    public function __construct(private EntityManagerInterface $entityManager, ProduitsRepository $produitRepository,CategoriesRepository $categorieRepository) {
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
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

        if ($_POST) {

            $produit = $form->getData();

            $date = new \DateTime();
            $date->setTime(0, 0, 0); // Définit l'heure sur 00:00:00

            $produit->setDateCreation($date);
            
            $categories = $this->categorieRepository->getAllCategories();

            // Vérifier si le nom du produit saisi dans le formulaire existe déjà
            if (in_array($_POST['form_produit']['categorie'], $categories)) {
                $this->addFlash('error', 'produit déjà existant.');
            }else{
                $this->entityManager->persist($produit);
                $this->entityManager->flush();
            }
           
            return $this->redirectToRoute('app_produit');
            
        }
    
        return $this->render('forms/formProduit.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouveau Produit',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/updProduit', name: 'app_form_produit_upd')]
    public function displayUpdForm(Request $request) : Response{
        $produits = new Produits();
        $form = $this->createForm(FormProduitType::class);

        $nom = $request->query->get('nom');
        

        // Récupérer l'objet Materiaux correspondant depuis la base de données
        $produits = $this->produitRepository->findOneBy(['nom' => $nom]);

        if (!$nom) {
            throw $this->createNotFoundException('Le produit n\'a pas été trouvé.');
        }

        // Créer le formulaire et le remplir avec les données du matériau
        $form = $this->createForm(FormProduitType::class, $produits);

        $form->handleRequest($request);

        if ($_POST) {
            // Pas besoin de récupérer $_POST, Symfony gère cela pour vous via le formulaire
    
            // Flush l'EntityManager pour mettre à jour les modifications dans la base de données
            $this->entityManager->flush();
    
            // Rediriger ou retourner une réponse appropriée
            return $this->redirectToRoute('app_produit');

        }
        return $this->render('forms/formProduit.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Modifier Produit',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteProduit', name: 'app_form_produit_delete')]
    public function displayDeleteForm(EntityManagerInterface $entityManager, $nom) : Response{

        $produit = $this->produitRepository->findOneBy(['nom' => $nom]);

        if (!$produit) {
            throw $this->createNotFoundException('Le produit n\'a pas été trouvé.');
        }

        // Supprimez l'élément de la base de données
        $entityManager->remove($produit);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_produit');
    }
}
