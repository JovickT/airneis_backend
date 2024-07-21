<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\FormCategorieType;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategorieController extends AbstractController
{
    private $categorieRepository;

    public function __construct(private EntityManagerInterface $entityManager,CategoriesRepository $categorieRepository) {
        $this->categorieRepository = $categorieRepository;
    }

    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie.html.twig', [
            'controller_name' => 'CategorieController',
            'title' => 'Liste de catégories',
            'categories' => $this->displaycategorie(),
            'tableHedears' => ['Nom', 'Image']
        ]);
    }

    public function displaycategorie(){

        $categories = $this->categorieRepository->getCategories();

        foreach ($categories as &$categorie) {
            unset($categorie['images']);
        }
        unset($categorie); // rompre la référence avec le dernier élément

        return $categories;
    }

    #[Route('/addCategorie', name: 'app_form_categorie')]
    public function displayAddForm(Request $request) : Response{

        $categorie = new Categories();
        $form = $this->createForm(FormCategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($_POST) {

            $categorie = $form->getData();

            $categories = $this->categorieRepository->getCategories();

            // Vérifier si le nom du produit saisi dans le formulaire existe déjà
            if (in_array($_POST['form_categorie']['nom'], $categories)) {
                $this->addFlash('error', 'Catégorie déjà existante.');
            }else{
                $this->entityManager->persist($categorie);
                $this->entityManager->flush();
            }
           
            return $this->redirectToRoute('app_categorie');
            
        }
    
        return $this->render('forms/formCategorie.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouvelle Catégorie',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/updCategorie', name: 'app_form_categorie_upd')]
    public function displayUpdForm(Request $request) : Response{
        $categories = new Categories();
        $form = $this->createForm(FormCategorieType::class);

        $nom = $request->query->get('nom');
        

        // Récupérer l'objet Materiaux correspondant depuis la base de données
        $categories = $this->categorieRepository->findOneBy(['nom' => $nom]);

        if (!$categories) {
            throw $this->createNotFoundException('La marque n\'a pas été trouvé.');
        }

        // Créer le formulaire et le remplir avec les données du matériau
        $form = $this->createForm(FormCategorieType::class, $categories);

        $form->handleRequest($request);

        if ($_POST) {
            // Pas besoin de récupérer $_POST, Symfony gère cela pour vous via le formulaire
    
            // Flush l'EntityManager pour mettre à jour les modifications dans la base de données
            $this->entityManager->flush();
    
            // Rediriger ou retourner une réponse appropriée
            return $this->redirectToRoute('app_marque');

        }
        return $this->render('forms/formCategorie.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Modifier Catégorie',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteCategorie{nom}', name: 'app_form_categorie_delete')]
    public function displayDeleteForm(EntityManagerInterface $entityManager, $nom) : Response{

        $categorie = $this->categorieRepository->findOneBy(['nom' => $nom]);

        if (!$categorie) {
            throw $this->createNotFoundException('La catégorie n\'a pas été trouvé.');
        }

        // Supprimez l'élément de la base de données
        $entityManager->remove($categorie);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_categorie');
    }
}
