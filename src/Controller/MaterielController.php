<?php

namespace App\Controller;

use App\Entity\Materiaux;
use App\Form\FormMaterielType;
use App\Repository\MateriauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MaterielController extends AbstractController
{

    private $materielRepository;

    public function __construct(MateriauxRepository $materielRepository) {
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
    
        return $this->render('forms/formMateriel.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouvelle Marque',
            'form' => $form->createView(),
        ]);
    }
}
