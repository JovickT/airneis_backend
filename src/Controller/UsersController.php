<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Adresses;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\FormClientType;
use App\Form\UserProfileType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;


class UsersController extends AbstractController
{

    private $clientRepository;
    private $passwordHasher;


    public function __construct(private EntityManagerInterface $entityManager, ClientRepository $clientRepository,UserPasswordHasherInterface $passwordHasher) {
        $this->clientRepository = $clientRepository;
        $this->passwordHasher = $passwordHasher;
       
    }

    #[Route('/liste', name: 'app_users')]
    public function index(): Response
    {
        return $this->render('user.html.twig', [
            'controller_name' => 'UsersController',
            'title' => 'Liste des Utilisateurs',
            'users' => $this->getAllUsers(),
            'tableHedears' => ['Prénom','Nom','Email','Téléphone','Rôle','Adresse']
        ]);
    }

    public function getAllUsers(){

        $users = $this->clientRepository->getAllUsers();

        // Faites quelque chose avec les utilisateurs, par exemple, les passer à un modèle pour les afficher dans une vue
        return  $users;
    }

    #[Route('/updUsers', name: 'app_form_users_upd')]
    public function displayUpdForm(Request $request) : Response{
        $users = new Client();
        $form = $this->createForm(FormClientType::class);

        $email = $request->query->get('email');
        

        // Récupérer l'objet Materiaux correspondant depuis la base de données
        $users = $this->clientRepository->findOneBy(['email' => $email]);

        if (!$users) {
            throw $this->createNotFoundException('L\'utilisateur n\'a pas été trouvé.');
        }

        // Créer le formulaire et le remplir avec les données du matériau
        $form = $this->createForm(FormClientType::class, $users, ['is_new' => false]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Pas besoin de récupérer $_POST, Symfony gère cela pour vous via le formulaire
            
            // Flush l'EntityManager pour mettre à jour les modifications dans la base de données
            $this->entityManager->flush();
    
            // Rediriger ou retourner une réponse appropriée
            return $this->redirectToRoute('app_users');

        }
        return $this->render('forms/formClient.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Modifier L\'utilisateur',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteUsers{email}', name: 'app_form_users_delete')]
    public function displayDeleteForm(EntityManagerInterface $entityManager, $email) : Response{

        $users = $this->clientRepository->findOneBy(['email' => $email]);

        if (!$users) {
            throw $this->createNotFoundException('L\'utilisateur n\'a pas été trouvé.');
        }

        // Supprimez l'élément de la base de données
        $entityManager->remove($users);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_users');
    }

    #[Route('/profile/edit', name: 'profile_edit')]
    #[IsGranted('ROLE_USER')]
    public function editpProfile(Request $request, EntityManagerInterface $entityManager, UserInterface $user): Response
    {
        $form = $this->createForm(UserProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Profil mis à jour avec succès.');

            return $this->redirectToRoute('profile_edit');
        }

        return $this->render('user/edit_profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/api/update-user', name: 'api_profile_edit', methods: ['PUT'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function editProfile(Request $request, Security $security): Response
    {
        $data = json_decode($request->getContent(), true);
        $user = $security->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        $client = $this->clientRepository->find($user->getIdClient());

        if (!$client) {
            return new JsonResponse(['message' => 'Client not found'], 404);
        }

        if (isset($data['prenom'])) {
            $client->setPrenom($data['prenom']);
        }
        if (isset($data['nom'])) {
            $client->setNom($data['nom']);
        }
        if (isset($data['email'])) {
            $client->setEmail($data['email']);
        }
        if (isset($data['telephone'])) {
            $client->setTelephone($data['telephone']);
        }

        $this->clientRepository->save($client);
        return new JsonResponse([
            'message' => 'Profile successfully updated',
            'client' => [
                'prenom' => $client->getPrenom(),
                'nom' => $client->getNom(),
                'email' => $client->getEmail(),
                'telephone' => $client->getTelephone(),
            ]
        ], 200);
    }

    #[Route('/api/change-password', name: 'api_change_password', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function changePassword(Request $request, UserPasswordHasherInterface $passwordHasher, Security $security): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $security->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        $client = $this->clientRepository->find($user->getIdClient());

        if (!$client) {
            return new JsonResponse(['message' => 'Client not found'], 404);
        }

        // Vérifier le mot de passe actuel
        if (!$passwordHasher->isPasswordValid($user, $data['currentPassword'])) {
            return new JsonResponse(['message' => 'Current password is incorrect'], 400);
        }

        // Vérifier que les nouveaux mots de passe correspondent
        if ($data['newPassword'] !== $data['repeatNewPassword']) {
            return new JsonResponse(['message' => 'New passwords do not match'], 400);
        }

        // Hasher et définir le nouveau mot de passe
        $hashedPassword = $passwordHasher->hashPassword($user, $data['newPassword']);
        $client->setPassword($hashedPassword);
        $this->clientRepository->save($client);
        
        return new JsonResponse(['message' => 'Le mot de passe a été modifié'], 200);
    }

    #[Route('/api/delete-account', name: 'api_delete_account', methods: ['DELETE'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function deleteAccount(Request $request, Security $security): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $security->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        $client = $this->clientRepository->find($user->getIdClient());

        if (!$client) {
            return new JsonResponse(['message' => 'Client not found'], 404);
        }

        $this->entityManager->remove($client);
        $this->entityManager->flush();

        
        return new JsonResponse(['message' => 'Le compte a bien été supprimé'], 200);
    }


    #[Route('/api/adresses', name: 'api_adresses', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function Adresses(Request $request, EntityManagerInterface $entityManager, Security $security, ValidatorInterface $validator, SerializerInterface $serializer): JsonResponse
    {

        $user = $security->getUser();
        $client = $this->clientRepository->find($user->getIdClient()); // Assurez-vous que cette méthode existe

        $adresses = $client->getAdresses(); 

        $errors = $validator->validate($adresses);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], 400);
        }

        return new JsonResponse(['success' => $adresses]);
    }

    #[Route('/api/add-adresse', name: 'api_adresse_create', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function createAdresse(Request $request, EntityManagerInterface $entityManager, Security $security, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $security->getUser();
        $client = $this->clientRepository->find($user->getIdClient()); // Assurez-vous que cette méthode existe

        $adresse = new Adresses();
        $adresse->setPays($data['pays']);
        $adresse->setVille($data['ville']);
        $adresse->setCodePostal($data['codePostal']);
        $adresse->setRue($data['rue']);

        $errors = $validator->validate($adresse);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], 400);
        }

        $client->addAdresse($adresse);
        $entityManager->persist($adresse);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Adresse créée avec succès', 'id' => $adresse->getId()], 201);
    }
}