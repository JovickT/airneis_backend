<?php

namespace App\Controller;

use App\Entity\Marques;
use App\Form\FormMarqueType;
use App\Repository\MarquesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MarqueController extends AbstractController
{

    private $marqueRepository;

    public function __construct(private EntityManagerInterface $entityManager,MarquesRepository $marqueRepository) {
        $this->marqueRepository = $marqueRepository;
    }

    #[Route('/marque', name: 'app_marque')]
    public function index(): Response
    {
        return $this->render('marque.html.twig', [
            'controller_name' => 'MarqueController',
            'title' => 'Liste de Marques',
            'marques' => $this->displayProduit(),
            'tableHedears' => ['Nom']
        ]);
    }

    public function displayProduit(){
        $marques = $this->marqueRepository->getMarques();

        return $marques;
    }

    #[Route('/addMarque', name: 'app_form_marque')]
    public function displayAddForm(Request $request) : Response{

        $marque = new Marques();
        $form = $this->createForm(FormMarqueType::class, $marque);
        $form->handleRequest($request);

        if ($_POST) {

            $marque = $form->getData();

            $marques = $this->marqueRepository->getMarques();

            // Vérifier si le nom du produit saisi dans le formulaire existe déjà
            if (in_array($_POST['form_marque']['nom'], $marques)) {
                $this->addFlash('error', 'marque déjà existante.');
            }else{
                $this->entityManager->persist($marque);
                $this->entityManager->flush();
            }
           
            return $this->redirectToRoute('app_marque');
            
        }
    
        return $this->render('forms/formMarque.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouvelle Marque',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/updMarque', name: 'app_form_marque_upd')]
    public function displayUpdForm(Request $request) : Response{
        $marques = new Marques();
        $form = $this->createForm(FormMarqueType::class);

        $nom = $request->query->get('nom');
        

        // Récupérer l'objet Materiaux correspondant depuis la base de données
        $marques = $this->marqueRepository->findOneBy(['nom' => $nom]);

        if (!$marques) {
            throw $this->createNotFoundException('La marque n\'a pas été trouvé.');
        }

        // Créer le formulaire et le remplir avec les données du matériau
        $form = $this->createForm(FormMarqueType::class, $marques);

        $form->handleRequest($request);

        if ($_POST) {
            // Pas besoin de récupérer $_POST, Symfony gère cela pour vous via le formulaire
    
            // Flush l'EntityManager pour mettre à jour les modifications dans la base de données
            $this->entityManager->flush();
    
            // Rediriger ou retourner une réponse appropriée
            return $this->redirectToRoute('app_marque');

        }
        return $this->render('forms/formMarque.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Modifier Marque',
            'form' => $form->createView(),
        ]);
    }

    #[Route('deleteMarque/{nom}', name: 'app_form_marque_delete')]
    public function displayDeleteForm(EntityManagerInterface $entityManager, $nom) : Response{

        $marque = $this->marqueRepository->findOneBy(['nom' => $nom]);

        if(!$marque){
            throw $this->createNotFoundException('La marque n\'a pas été trouvé.');
        }

        // Supprimez l'élément de la base de données
        $entityManager->remove($marque);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_marque');
    }

    
}
