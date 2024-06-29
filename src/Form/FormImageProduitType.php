<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\ImageProduit;
use App\Entity\Produits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormImageProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('id_image', EntityType::class, [
            'class' => Image::class,
            'choice_label' => function (Image $image) {
                return $image->getLien(); // Remplacez par l'attribut descriptif approprié
            },
            'choice_attr' => function (Image $image, $key, $value) {
                return ['data-image-path' => $image->getLien()];
            },
            'placeholder' => 'Sélectionner une image',
        ])
        ->add('id_produit', EntityType::class, [
            'class' => Produits::class,
            'choice_label' => 'nom', // Remplacez par l'attribut descriptif approprié
            'placeholder' => 'Sélectionner un produit',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImageProduit::class,
              'csrf_protection' => false, // Désactiver la protection CSRF
        ]);
    }
}
