<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\ImageProduit;
use App\Entity\Produits;
use App\Form\FormImageProduitType;
use App\Form\FormImageType;
use App\Form\FormProduitType;
use App\Repository\CategoriesRepository;
use App\Repository\ImageProduitRepository;
use App\Repository\ImageRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    private $produitRepository;
    private $categorieRepository;
    private $imageProduitRepository;
    private $imageRepository;

    public function __construct(private EntityManagerInterface $entityManager, ProduitsRepository $produitRepository,
    CategoriesRepository $categorieRepository, ImageProduitRepository $imageProduitRepository,
    ImageRepository $imageRepository) {
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
        $this->imageProduitRepository = $imageProduitRepository;
        $this->imageRepository = $imageRepository;
    }

    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit.html.twig', [
            'controller_name' => 'ProduitController',
            'title' => 'Liste de Produits',
            'produits' => $this->displayProduit(),
            'tableHedears' => ['Référence','Nom','Prix €','Description','Quantité','Date de création','Marque','Catégorie','Image']
        ]);
    }

    public function displayProduit(){
        $produits = $this->produitRepository->getProduits();
        foreach ($produits as &$produit) {
            unset($produit['images']);
        }
        unset($produit); // rompre la référence avec le dernier élément
        
        return $produits;
    }

    private function getImagesFromUploads(): array
{
    $finder = new Finder();
    $finder->files()->in($this->getParameter('images_directory'));

    $images = [];
    foreach ($finder as $file) {
        $images[$file->getFilename()] = $file->getFilename();
    }

    return $images;
}

    #[Route('/addProduct', name: 'app_form_produit')]
    public function displayAddForm(Request $request): Response
    {
        $produit = new Produits();

        // Passez le chemin des images disponibles au formulaire
        $form = $this->createForm(FormProduitType::class, $produit, [
            'images_directory' => $this->getParameter('images_directory'),
        ]);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $produit = $form->getData();
    
            // Récupération des images sélectionnées
            $selectedImages = $form->get('images')->getData();
            foreach ($selectedImages as $imageFilename) {
                $img = $this->imageRepository->findOneBy(['lien' => $imageFilename]);
                $newImageproduit = new ImageProduit();
                if(isset($img)) {
                    $newImageproduit->setProduit($produit);
                    $newImageproduit->setImage($img);

                    $this->entityManager->persist($newImageproduit);
                }

            }
    
            $date = new \DateTime();
            $date->setTime(0, 0, 0);
            $produit->setDateCreation($date);
    
            $this->entityManager->persist($produit);
            $this->entityManager->flush();
    
            return $this->redirectToRoute('app_produit');
        }
    
        return $this->render('forms/formProduit.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouveau Produit',
            'form' => $form->createView(),
            'images' => [], // Pas d'images pour un nouveau produit
        ]);
    }



    #[Route('/updProduit', name: 'app_form_produit_upd')]
    public function displayUpdForm(Request $request) : Response{
        $nom = $request->query->get('nom');
        $produits = $this->produitRepository->findOneBy(['nom' => $nom]);
    
        if (!$produits) {
            throw $this->createNotFoundException('Le produit n\'a pas été trouvé.');
        }
    
        $images = $produits->getProduitImages();

        foreach ($images as $key => $image) {
            $imagesProduit[] = $image->getImage()->getLien();
        }
    
        // Passez le chemin des images disponibles au formulaire
        $form = $this->createForm(FormProduitType::class, $produits, [
            'images_directory' => $this->getParameter('images_directory'),
        ]);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des images sélectionnées
            $selectedImages = $form->get('images')->getData();
            foreach ($selectedImages as $imageFilename) {
                $img = $this->imageRepository->findOneBy(['lien' => $imageFilename]);
                $newImageproduit = new ImageProduit();
                if(isset($img)) {
                    $newImageproduit->setProduit($produits);
                    $newImageproduit->setImage($img);

                    $this->entityManager->persist($newImageproduit);
                }

            }
    
            $this->entityManager->flush();
    
            return $this->redirectToRoute('app_produit');
        }
    
        return $this->render('forms/formProduit.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Modifier Produit',
            'form' => $form->createView(),
            'images' => $imagesProduit, // Passez les images associées au produit
        ]);
    }
    

    #[Route('/deleteProduit{nom}', name: 'app_form_produit_delete')]
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
