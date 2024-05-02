<?php

namespace App\Controller;

use App\Entity\Marques;
use App\Form\FormMarqueType;
use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MarqueController extends AbstractController
{

    private $marqueRepository;

    public function __construct(MarquesRepository $marqueRepository) {
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
    
        return $this->render('forms/formMarque.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouvelle Marque',
            'form' => $form->createView(),
        ]);
    }
}
