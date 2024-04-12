<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\FormClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UsersController extends AbstractController
{

    private $clientRepository;


    public function __construct(private EntityManagerInterface $entityManager, ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;
       
    }

    #[Route('/liste', name: 'app_users')]
    public function index(): Response
    {
        return $this->render('user.html.twig', [
            'controller_name' => 'UsersController',
            'users' => $this->getAllUsers(),
            'tableHedears' => ['Prénom','Nom','Email','Téléphone','Rôle','Adresse']
        ]);
    }

    public function getAllUsers(){

        $users = $this->clientRepository->getAllUsers();

        // Faites quelque chose avec les utilisateurs, par exemple, les passer à un modèle pour les afficher dans une vue
        return  $users;
    }

}
