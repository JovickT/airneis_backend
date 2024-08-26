<?php

namespace App\Controller;

use App\Entity\Adresses;
use App\Entity\Carrousel;
use App\Entity\Client;
use App\Form\FormCarrouselType;
use App\Form\FormClientType;
use App\Form\MessageFormType;
use App\Repository\AdressesRepository;
use App\Repository\CarrouselRepository;
use App\Repository\ClientRepository;
use App\Repository\ContactRepository;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    private $clientRepository;
    private $adresseRepository;
    private $imageRepository;
    private $carrouselRepository;
    private $contactRepository;
    // private $imageCarrouselRepository;
    
    public function __construct(
        private EntityManagerInterface $entityManager,
        ClientRepository $clientRepository,
        AdressesRepository $adresseRepository,
        ImageRepository $imageRepository,
        CarrouselRepository $carrouselRepository,
        ContactRepository $contactRepository,
        // ImageCarouselRepository $imageCarrouselRepository,
    ) {
        $this->clientRepository = $clientRepository;
        $this->adresseRepository = $adresseRepository;
        $this->imageRepository = $imageRepository;
        $this->carrouselRepository = $carrouselRepository;
        $this->contactRepository = $contactRepository;
        // $this->imageCarrouselRepository = $imageCarrouselRepository;
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
        $form = $this->createForm(FormClientType::class, $client,['is_new' => true]);
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
                ->addAdresse($adresse); // Attribuez l'adresse à l'utilisateur
    
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

    #[Route('/displayCarrouselImages', name: 'app_displayCarrouselImages')]
    public function displayCarrouselImages(Request $request) : Response{
       
        $carrosuel =  $this->carrouselRepository->findAll();
        $infos = [];
        foreach ($carrosuel as $key => $value) {
            $images = $value->getImages();
            $infos[] =[
                'id' => $value->getId(),
                'nom' => $value->getNom(),
                'rang' => $value->getRang()
            ];
            foreach ($images as $jey => $image) {
                $infos[$key]['display'] = "<img src='/uploads/{$image->getLien()}' alt='Image' width='100' />";
            }
        }

        return $this->render('carrousel.html.twig', [
            'controller_name' => 'formClientController',
            'infos' => $infos,
            'title' => "Formualire Ajout de Carrousel",
            'tableHedears' => ['Id','Nom','Rang','Images']
        ]);
    }

    #[Route('/allMessages', name: 'app_all_messages')]
    public function allMessages(): Response
    {
        return $this->render('messages.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/theMessage/{id}', name: 'app_the_message')]
    public function show(Request $request, $id, MailerInterface $mailer): Response
    {
        $message = $this->contactRepository->find($id);

        $form = $this->createForm(MessageFormType::class, [
            'email' => $message->getEmail(),
            'message' => $message->getMessage()
        ]);

        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $response = $data['response'];
            $to = $data['email'];
            
            $email = (new Email())
                ->from('contact@airneis.com')
                ->to($to)
                ->subject('Réponse à votre email')
                ->text($response);

            try {
                $mailer->send($email);
                $this->addFlash('success', 'Email envoyé avec succès!');
            } catch (TransportExceptionInterface $e) {
                $this->addFlash('error', 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
            }

            return $this->redirectToRoute('app_the_message', ['id' => $id]);
        }

        return $this->render('response.html.twig', [
            'form' => $form->createView(),
            'message' => $message
        ]);
    }

    #[Route('/carrousel/new', name: 'carrousel_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, ImageRepository $imageRepository): Response
    {
        $carrousel = new Carrousel();
        $form = $this->createForm(FormCarrouselType::class, $carrousel, [
            'image_repository' => $imageRepository, // Passe le repository ici
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $selectedImages = $form->get('images')->getData();
            foreach ($selectedImages as $imageFilename) {
                $img = $this->imageRepository->findOneBy(['lien' => $imageFilename]);
                $carrousel->addImage($img);
            }
            $entityManager->persist($carrousel);
            $entityManager->flush();

            return $this->redirectToRoute('app_displayCarrouselImages'); // Redirection après succès
        }

        return $this->render('forms/formCarrousel.html.twig', [
            'carrousel' => $carrousel,
            'form' => $form->createView(),
            'title' => 'Nouveau Carrousel',
            'images' => []
        ]);
    }

    #[Route('/carrousel/update', name: 'carrousel_update')]
    public function update(Request $request, EntityManagerInterface $entityManager, ImageRepository $imageRepository): Response
    {
        $id = $request->query->get('id');

        $carrousel = $this->carrouselRepository->find($id);

        if (!$carrousel) {
            throw $this->createNotFoundException('Le carrousel n\'a pas été trouvé.');
        }

        $images = $carrousel->getImages();

        foreach ($images as $key => $image) {
            $infoImage[] = $image->getLien();
        }

        $form = $this->createForm(FormCarrouselType::class, $carrousel, [
            'image_repository' => $imageRepository, // Passe le repository ici
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $selectedImages = $form->get('images')->getData();

            $img = $this->imageRepository->findOneBy(['lien' => $selectedImages]);

             // Supprimer les associations existantes
            foreach ($carrousel->getImages() as $existingImage) {
                $carrousel->removeImage($existingImage);
            }

            foreach ($selectedImages as $imageFilename) {
                $carrousel->addImage($img);
            }
            $entityManager->persist($carrousel);
            $entityManager->flush();

            return $this->redirectToRoute('app_displayCarrouselImages'); // Redirection après succès
        }

        return $this->render('forms/formCarrousel.html.twig', [
            'carrousel' => $carrousel,
            'form' => $form->createView(),
            'title' => 'Modifier Carrousel',
            'images' => $infoImage
        ]);
    }

    #[Route('/carrousel/remove', name: 'carrousel_remove')]
    public function remove(Request $request, EntityManagerInterface $entityManager, Carrousel $carrousel): Response
    {
       

        return $this->redirectToRoute('app_displayCarrouselImages'); // Redirection après succès

    }
    
}
