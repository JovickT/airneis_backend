<?php
// src/Controller/ImageController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Image;
use App\Form\FormImageType;
use App\Repository\ImageRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImageController extends AbstractController
{

    private $imageRepository;

    public function __construct(private EntityManagerInterface $entityManager, ImageRepository $imageRepository) {
        $this->imageRepository = $imageRepository;
    }
    
    #[Route('/upload', name: 'image_upload')]
    public function upload(Request $request, EntityManagerInterface $em, SluggerInterface $slugger,PictureService $pictureService): Response
    {
        $image = new Image();   
        $form = $this->createForm(FormImageType::class, $image, [
            'is_edit' => false,  // Pas en mode édition
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $files = $form->get('image')->getData();
            $nom = $form->get('nom')->getData();

            foreach ($files as $key => $file) {
                //on définie le dossier de destination 
                $folder = 'images';
                // on appelle le service d'ajout
                $fichier = $pictureService->add($file,$folder,300,300);

                $image = new Image();   
                $image->setLien($fichier);
                $image->setNom($nom);
                $em->persist($image);
            }
            if($fichier){
                $em->flush();

                $this->addFlash('success', 'Image uploaded successfully');
                return $this->redirectToRoute('app_image'); 
            }else{
                $this->addFlash('error', 'Image uploaded error');
                return $this->redirectToRoute('image_upload'); 
            }
           
        }

        return $this->render('forms/formImage.html.twig', [
            'form' => $form->createView(),
            'title' => "Ajouter une image",
            'images' => []
        ]);
    }

    #[Route('/images', name: 'app_image')]
    public function index(): Response
    {
        $images = $this->imageRepository->displayImage();
        return $this->render('image.html.twig', [
            'controller_name' => 'ImageController',
            'title' => 'Liste des Images',
            'images' => $images,
            'tableHedears' => ['Nom','Images','Affichage']
        ]);
    }

    #[Route('/updImages', name: 'app_form_image_upd')]
    public function update(Request $request): Response
    {
        $lien = $request->query->get('lien');
        $images = $this->imageRepository->findOneBy(['lien' => $lien]);
    
        $form = $this->createForm(FormImageType::class, $images, [
            'is_edit' => true,  // En mode édition
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {    
    
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Image updated successfully');
    
            return $this->redirectToRoute('app_image');  // Redirige vers la liste des images ou une autre page
        }
    
        return $this->render('forms/formImage.html.twig', [
            'controller_name' => 'ImageController',
            'title' => 'Modifier une image',  // Pour la modification
            'form' => $form->createView(),
            'images' => $images,  // Ajouter l'image pour l'aperçu
        ]);
    }

    #[Route('/removeImage', name: 'app_form_image_remove')]
    public function remove(Request $request, EntityManagerInterface $em): Response
    {
        $lien = $request->query->get('lien');
        $image = $this->imageRepository->findOneBy(['lien' => $lien]);
    
        if (!$image) {
            $this->addFlash('error', 'Image not found');
            return $this->redirectToRoute('app_image');
        }
    
        // Suppression de l'image de la base de données
        $em->remove($image);
        $em->flush();
    
        $this->addFlash('success', 'Image removed successfully');
    
        return $this->redirectToRoute('app_image');
    }
    
    
}
