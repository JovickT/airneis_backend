<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApiController extends AbstractController
{
    private $produitRepository;
    private $categorieRepository;

    public function __construct(ProduitsRepository $produitRepository,CategoriesRepository $categorieRepository) {
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
    }

    #[Route('/api/data', name: 'frontend_data')]
    public function fetchData(): JsonResponse
    {
        // Logique pour récupérer les données et les renvoyer
        $data['produit'] =  $this->produitRepository->getProduits();  // Données à renvoyer
        $data['categorie'] =  $this->categorieRepository->getCategories();  // Données à renvoyer
        return $this->json($data , 200, [
            'Access-Control-Allow-Origin' => '*'
        ]);
    }

    
    #[Route('api/register', name : 'register_data')] 
    public function registerApi(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(RegistrationFormType::class, null, ['csrf_protection' => false]);
        $form->submit($data);

        if (!$form->isValid()) {
            // Renvoyer les erreurs de validation
            // $errors = $this->$form;
            // return $this->json($errors, 400);
        }

        $user = new Client();
        $user->setEmail($data['email']);
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);
        $plainPassword = $request->request->get('password');
        $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        $entityManager->persist($user);
        $entityManager->flush();

        // Générer un token JWT pour l'utilisateur nouvellement inscrit
        $token = $this->get('jwt_token_manager')->create($user);

        return $this->json([
            'token' => $token,
            'user' => $user->getEmail()
        ]);
    }   
}
