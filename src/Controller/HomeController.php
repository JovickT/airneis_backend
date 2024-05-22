<?php

namespace App\Controller;

use App\Entity\Adresses;
use App\Entity\Client;
use App\Form\FormClientType;
use App\Repository\AdressesRepository;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    private $clientRepository;
    private $adresseRepository;
    
    public function __construct(private EntityManagerInterface $entityManager, ClientRepository $clientRepository,AdressesRepository $adresseRepository) {
        $this->clientRepository = $clientRepository;
        $this->adresseRepository = $adresseRepository;
    }

    #[Route('/dashbord', name: 'app_home')]
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

        if ($form->isSubmitted() && $form->isValid()) {
           //if($client->getPassword() != null){
                $motDePasse = $client->getPassword();
        //    }else{
        //         $email = $client -> getEmail();
        //         $users = $this->clientRepository->findOneBy(['email' => $email]);
        //         $motDePasse = $users->getPassword();
        //    }
            // Hacher le mot de passe
           
            $mdpHash = password_hash($motDePasse, PASSWORD_DEFAULT);
            
            // Enregistrer le mot de passe haché
            $client->setPassword($mdpHash);
    
            // Enregistrer le client dans la base de données
            $this->entityManager->persist($client);
            $this->entityManager->flush();
    
            // Rediriger l'utilisateur ou afficher un message de succès
            return $this->redirectToRoute('app_users');
        }

        return $this->render('forms/formClient.html.twig', [
            'controller_name' => 'formClientController',
            'title' => 'Nouvelle Utilisateur',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/userCreate', name: 'app_userCreate')]
    public function userCreate(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $email = $data['email'];
        $plaintextPassword = $data['mot_de_passe'];
        $roles = $data['roles'];
        $prenom = $data['prenom'];
        $nom = $data['nom'];
        $adress = $data['adresse'];
        $telephone = $data['telephone'];
    
        $email_exist = $this->clientRepository->findOneBy(['email' => $email]);
    
        if ($email_exist) {
            return new JsonResponse([
                'status' => false,
                'message' => 'Cet email existe déjà, veuillez le changer'
            ]);
        } else {
            $user = new Client();
            $adresse = $this->adresseRepository->findOneBy([
                'pays' => $adress['pays'],
                'ville' => $adress['ville'],
                'code_postal' => $adress['code_postal'],
                'rue' => $adress['rue']
            ]);
            
            // Si l'adresse n'existe pas, créez une nouvelle instance de Adresse
            if (!$adresse) {
                $adresse = new Adresses();
                $adresse
                    ->setPays($adress['pays'])
                    ->setVille($adress['ville'])
                    ->setCodePostal($adress['code_postal'])
                    ->setRue($adress['rue']);
                
                $this->entityManager->persist($adresse);
            }
    
            // Configurez les détails de l'utilisateur
            $user
                ->setEmail($email)
                ->setRoles($roles)
                ->setNom($nom)
                ->setPrenom($prenom)
                ->setTelephone($telephone)
                ->setAdresse($adresse); // Attribuez l'adresse à l'utilisateur
    
            // Utilisez la méthode registration pour hacher le mot de passe et définissez-le sur l'utilisateur
            $hashedPassword = $this->registration($passwordHasher, $user, $plaintextPassword);
    
            $this->entityManager->persist($user);
            $this->entityManager->flush();
    
            return new JsonResponse([
                'status' => true,
                'message' => 'L\'utilisateur a été créé avec succès',
                'hashed_password' => $hashedPassword,
            ]);
        }
    }
    
    private function registration(UserPasswordHasherInterface $passwordHasher, Client $user, string $plaintextPassword): String
    {
        // Hachez le mot de passe en utilisant UserPasswordHasherInterface
        $hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);
        
        // Définissez le mot de passe haché sur l'objet User
        $user->setPassword($hashedPassword);

        return $hashedPassword;
    }


    
}
