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
        $form = $this->createForm(FormImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $files = $form->get('image')->getData();

            foreach ($files as $key => $file) {
                //on définie le dossier de destination 
                $folder = 'images';
                // on appelle le service d'ajout
                $fichier = $pictureService->add($file,$folder,300,300);

                $image = new Image();   
                $image->setLien($fichier);
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
            'title' => "Téléchargement d'Image",
        ]);
    }

    #[Route('/images', name: 'app_image')]
    public function index(): Response
    {
        // dd($this->imageRepository->displayImage());
        return $this->render('image.html.twig', [
            'controller_name' => 'ImageController',
            'title' => 'Liste des Images',
            'images' => $this->imageRepository->displayImage(),
            'tableHedears' => ['Images','Affichage']
        ]);
    }
}
