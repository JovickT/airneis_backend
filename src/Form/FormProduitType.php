<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Image;
use App\Entity\Marques;
use App\Entity\Produits;
use App\Repository\ImageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormProduitType extends AbstractType
{
    private $imageRepository;

    public function __construct(ImageRepository $imageRepository) {
        $this->imageRepository = $imageRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $imagesDirectory = $this->imageRepository->findAll();
        $imageChoices = [];

        foreach ($imagesDirectory as $img) {
            if(isset($img)) {
                $imageChoices[$img->getnom()] = $img->getLien(); // Texte affiché et valeur identiques
            }
        }

        $builder
            ->add('reference', null, [
                'attr' => [
                    'name' => 'reference',
                    'readonly' => 'readonly' // Rend l'entrée en lecture seule
                ],
            ])
            ->add('nom', null, [
                'attr' => [
                    'name' => 'nom',
                ],
            ])
            ->add('prix', null, [
                'attr' => [
                    'name' => 'prix',
                ],
            ])
            ->add('description', null, [
                'attr' => [
                    'name' => 'description',
                ],
            ])
            ->add('quantite', null, [
                'attr' => [
                    'name' => 'quantite',
                ],
            ])
            ->add('date_creation', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(), // Définit la date par défaut comme la date du jour
                'attr' => [
                    'readonly' => 'readonly', // Rend l'entrée en lecture seule
                ],
            ])
            ->add('marque', EntityType::class, [
                'class' => Marques::class, // Remplacez Marque::class par votre entité de marque
                'choice_label' => 'nom', // Le champ de l'entité à afficher dans la liste déroulante
                'placeholder' => 'Choisir une marque', // Optionnel : message affiché par défaut
                'attr' => ['class' => 'form-control',
                'name' => 'marque'
                ] // Classes CSS supplémentaires
                
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categories::class, // Remplacez Categorie::class par votre entité de catégorie
                'choice_label' => 'nom', // Le champ de l'entité à afficher dans la liste déroulante
                'placeholder' => 'Choisir une catégorie', // Optionnel : message affiché par défaut
                'attr' => ['class' => 'form-control',
                'name' => 'categorie'
                ] // Classes CSS supplémentaires
                
            ])
            // Champ pour sélectionner des images existantes
            ->add('images', ChoiceType::class, [
                'choices' => $imageChoices,
                'multiple' => true,
                'expanded' => false,
                'mapped' => false,  // Non lié directement à l'entité Produit
                'required' => false,
                'label' => 'Sélectionnez des images',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => ['class' => 'btn-block btn-primary col-sm-6 mt-2'],
            ])
        ;
    }

      public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);

        $resolver->setRequired('images_directory');
    }
}
