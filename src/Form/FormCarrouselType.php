<?php

namespace App\Form;

use App\Entity\Carrousel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormCarrouselType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $imageRepository = $options['image_repository']; // Récupère le repository depuis les options
        $imagesDirectory = $imageRepository->findAll();
        $imageChoices = [];
        $carrousel = $options['data'];
        $selectedImages = $carrousel->getImages()->toArray();
        foreach ($imagesDirectory as $img) {
            if(isset($img)) {
                $imageChoices[$img->getNom()] = $img->getLien(); // Texte affiché et valeur identiques
            }
        }

        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du carrousel',
            ])
            ->add('rang', IntegerType::class, [
                'label' => 'Rang du carrousel',
            ])
            ->add('images', ChoiceType::class, [
                'choices' => $imageChoices,
                'multiple' => true,
                'expanded' => false,
                'mapped' => false,  // Non lié directement à l'entité Carrousel
                'required' => false,
                'label' => 'Sélectionnez des images',
                'data' => array_map(fn($image) => $image->getLien(), $selectedImages), // Images sélectionnées par défaut
           ])
           ->add('save', SubmitType::class, [
            'label' => 'Ajouter',
            'attr' => ['class' => 'btn-block btn-primary col-sm-6 mt-2'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carrousel::class,
        ]);

        // Déclare l'option 'image_repository'
        $resolver->setRequired('image_repository');
    }
}