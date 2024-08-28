<?php

namespace App\Controller;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AdminRegistrationFormType;
use App\Form\AdminProfileType;
use App\Repository\AdminRepository;
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


class AdminController extends AbstractController
{

    private $AdminRepository;
    private $passwordHasher;


    public function __construct(private EntityManagerInterface $entityManager, AdminRepository $AdminRepository,UserPasswordHasherInterface $passwordHasher) {
        $this->AdminRepository = $AdminRepository;
        $this->passwordHasher = $passwordHasher;
       
    }

    #[Route('/liste_admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin.html.twig', [
            'controller_name' => 'UsersController',
            'title' => 'Liste des admin',
            'users' => $this->getAllUsers(),
            'tableHedears' => ['Prénom','Nom','Email','Rôle']
        ]);
    }

    public function getAllUsers(){

        $users = $this->AdminRepository->getAllUsers();

        // Faites quelque chose avec les utilisateurs, par exemple, les passer à un modèle pour les afficher dans une vue
        return  $users;
    }

    #[Route('/addAdmin', name: 'app_form_admin')]
    public function displayAddForm(Request $request) : Response{
        $admin = new Admin();
        $form = $this->createForm(AdminRegistrationFormType::class, $admin,['is_new' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           //if($admin->getPassword() != null){
                $motDePasse = $admin->getPassword();
        //    }else{
        //         $email = $admin -> getEmail();
        //         $users = $this->adminRepository->findOneBy(['email' => $email]);
        //         $motDePasse = $users->getPassword();
        //    }
            // Hacher le mot de passe
           
            $mdpHash = password_hash($motDePasse, PASSWORD_DEFAULT);
            
            // Enregistrer le mot de passe haché
            $admin->setPassword($mdpHash);
    
            // Enregistrer le admin dans la base de données
            $this->entityManager->persist($admin);
            $this->entityManager->flush();
    
            // Rediriger l'utilisateur ou afficher un message de succès
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('forms/formadmin.html.twig', [
            'controller_name' => 'formadminController',
            'title' => 'Nouvel administrateur',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/updAdmin', name: 'app_form_admin_upd')]
    public function displayUpdForm(Request $request) : Response{
        $users = new Admin();
        $form = $this->createForm(AdminRegistrationFormType::class);

        $email = $request->query->get('email');
        

        // Récupérer l'objet Materiaux correspondant depuis la base de données
        $users = $this->AdminRepository->findOneBy(['email' => $email]);

        if (!$users) {
            throw $this->createNotFoundException('L\'utilisateur n\'a pas été trouvé.');
        }

        // Créer le formulaire et le remplir avec les données du matériau
        $form = $this->createForm(AdminRegistrationFormType::class, $users, ['is_new' => false]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Pas besoin de récupérer $_POST, Symfony gère cela pour vous via le formulaire
            
            // Flush l'EntityManager pour mettre à jour les modifications dans la base de données
            $this->entityManager->flush();
    
            // Rediriger ou retourner une réponse appropriée
            return $this->redirectToRoute('app_admin');

        }
        return $this->render('forms/formAdmin.html.twig', [
            'controller_name' => 'formAdminController',
            'title' => 'Modifier L\'administrateur',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteUsers{email}', name: 'app_form_admin_delete')]
    public function displayDeleteForm(EntityManagerInterface $entityManager, $email) : Response{

        $users = $this->AdminRepository->findOneBy(['email' => $email]);

        if (!$users) {
            throw $this->createNotFoundException('L\'utilisateur n\'a pas été trouvé.');
        }

        // Supprimez l'élément de la base de données
        $entityManager->remove($users);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/admin_profile/edit', name: 'admin_profile_edit')]
    public function editProfile(Request $request, EntityManagerInterface $entityManager, UserInterface $user): Response
    {
        $form = $this->createForm(AdminProfileType::class, $user);
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

   
}