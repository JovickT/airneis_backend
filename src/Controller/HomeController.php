<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Client;
use App\Repository\CategoriesRepository;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{
    private $clientRepository;
    
    public function __construct(private EntityManagerInterface $entityManager, ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            // Récupérer les données soumises via le formulaire
            $prenom = $request->request->get('prenom');
            $nom = $request->request->get('nom');
            $email = $request->request->get('email');
            $adresse = $request->request->get('adresse');
            $phone = $request->request->get('telephone');
            $mdp = $request->request->get('mdp');

            $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

            // Créer une instance de votre entité
            $client = new Client(); // Remplacez "VotreEntity" par le nom de votre entité
            $adress = new Adresse(); 

            $shearch = $adress->getRue()." ".$adress->getCodePostal()." ".$adress->getVille();
            if($shearch == $adresse){
                $idadresse = $adress->getId();
            }else{
                $idadresse = null;
            }

            // Définir les valeurs des propriétés de l'entité avec les données reçues
            $client->setPrenom($prenom);
            $client->setNom($nom);
            $client->setEmail($email);
            $client->setIdAdresse($idadresse);
            $client->setTelephone($phone);
            $client->setMotdepasse($mdpHash);

            // Enregistrer l'entité dans la base de données
            $this->entityManager->persist($client);
            $this->entityManager->flush();

            // Rediriger l'utilisateur ou afficher un message de succès
            // Par exemple, rediriger vers une autre page
            return $this->redirectToRoute('app_home');
        }

      
        return $this->render('layout.html.twig', [
            'controller_name' => 'HomeController'
        ]);
    }
}