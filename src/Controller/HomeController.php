<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\FormClientType;
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
    public function index(): Response
    {
        return $this->render('layout.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/addClient', name: 'app_form_client')]
    public function displayAddForm(Request $request) : Response{
        $client = new Client();
        $form = $this->createForm(FormClientType::class, $client);
        $form->handleRequest($request);

        if ($_POST) {
            // Récupérer les données du formulaire
            $client = $form->getData();
            $motDePasse = $client->getMotDePasse();
            $verifMotDePasse = $request->request->get('verif_mdp');

            $emails = $this->clientRepository->getAllEmails();

            // Vérifier si l'e-mail saisi dans le formulaire existe déjà
            if (in_array($_POST['form_client']['email'], $emails)) {
                $this->addFlash('error', 'Utilisateur déjà existant.');
            } else if ($motDePasse !== $verifMotDePasse) {// Vérifier l'égalité des mots de passe
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
            } else {
                // Hacher le mot de passe
                $mdpHash = password_hash($motDePasse, PASSWORD_DEFAULT);

                // Enregistrer le mot de passe haché
                $client->setMotDePasse($mdpHash);

                // Enregistrer le client dans la base de données
                $this->entityManager->persist($client);
                $this->entityManager->flush();

                // Rediriger l'utilisateur ou afficher un message de succès
                // Par exemple, rediriger vers une autre page
                return $this->redirectToRoute('app_users');
            }
        }

        return $this->render('forms/formClient.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouvelle Utilisateur',
            'form' => $form->createView(),
        ]);
    }
}
