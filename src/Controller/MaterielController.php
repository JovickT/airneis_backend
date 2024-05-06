<?php

namespace App\Controller;

use App\Entity\Materiaux;
use App\Form\FormMaterielType;
use App\Repository\MateriauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MaterielController extends AbstractController
{

    private $materielRepository;

    public function __construct(private EntityManagerInterface $entityManager, MateriauxRepository $materielRepository) {
        $this->materielRepository = $materielRepository;
    }

    #[Route('/materiel', name: 'app_materiel')]
    public function index(): Response
    {
        return $this->render('materiel.html.twig', [
            'controller_name' => 'MaterielController',
            'title' => 'liste des Matériaux',
            'materiaux' => $this->displayMateriel(),
            'tableHedears' => ['Nom']
        ]);
    }

    public function displayMateriel(){
        $materiaux = $this->materielRepository->getMateriaux();

        return $materiaux;
    }

    #[Route('/addMateriel', name: 'app_form_materiel')]
    public function displayAddForm(Request $request) : Response{

        $materiel = new Materiaux();
        $form = $this->createForm(FormMaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($_POST) {

            $materiel = $form->getData();

            $materiels = $this->materielRepository->getMateriaux();

            // Vérifier si le nom du produit saisi dans le formulaire existe déjà
            if (in_array($_POST['form_materiel']['nom'], $materiels)) {
                $this->addFlash('error', 'matériaux déjà existant.');
            }else{
                $this->entityManager->persist($materiel);
                $this->entityManager->flush();
            }
           
            return $this->redirectToRoute('app_materiel');
            
        }
    
        return $this->render('forms/formMateriel.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouveau Matériaux',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/updMateriel', name: 'app_form_materiel_upd')]
    public function displayUpdForm(Request $request) : Response{
        $materiaux = new Materiaux();
        $form = $this->createForm(FormMaterielType::class);

        $nom = $request->query->get('nom');
        

        // Récupérer l'objet Materiaux correspondant depuis la base de données
        $materiaux = $this->materielRepository->findOneBy(['nom' => $nom]);

        if (!$materiaux) {
            throw $this->createNotFoundException('Le matériau n\'a pas été trouvé.');
        }

        // Créer le formulaire et le remplir avec les données du matériau
        $form = $this->createForm(FormMaterielType::class, $materiaux);

        $form->handleRequest($request);

        if ($_POST) {
            // Pas besoin de récupérer $_POST, Symfony gère cela pour vous via le formulaire
    
            // Flush l'EntityManager pour mettre à jour les modifications dans la base de données
            $this->entityManager->flush();
    
            // Rediriger ou retourner une réponse appropriée
            return $this->redirectToRoute('app_materiel');

        }
        return $this->render('forms/formMateriel.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Modifier Matériaux',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteMateriel', name: 'app_form_materiel_delete')]
    public function displayDeleteForm(EntityManagerInterface $entityManager, $nom) : Response{

        $materiaux = $this->materielRepository->findOneBy(['nom' => $nom]);

        if (!$materiaux) {
            throw $this->createNotFoundException('Le matériau n\'a pas été trouvé.');
        }

        // Supprimez l'élément de la base de données
        $entityManager->remove($materiaux);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_materiel');
    }

}
