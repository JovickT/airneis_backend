<?php

namespace App\Controller;

use App\Entity\Client;
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
use Symfony\Component\Validator\Validator\ValidatorInterface;
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

    #[Route('/api/profile', name: 'api_profile_edit', methods: ['PUT'])]
    public function editProfile(
        Request $request,
        EntityManagerInterface $entityManager,
        UserInterface $user, Security $security,
        ValidatorInterface $validator,
        SerializerInterface $serializer
    ): JsonResponse
    {
        $user = $security->getUser();
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return new JsonResponse(['error' => 'Invalid JSON'], 400);
        }

        if (isset($data['prenom'])) $user->setPrenom($data['prenom']);
        if (isset($data['nom'])) $user->setNom($data['nom']);
        if (isset($data['email'])) $user->setEmail($data['email']);
        if (isset($data['telephone'])) $user->setTelephone($data['telephone']);

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], 400);
        }

        $entityManager->flush();

        return new JsonResponse([
            'message' => 'Profil mis à jour avec succès',
            'user' => $serializer->normalize($user, null, ['groups' => 'user'])
        ]);
    }

}
