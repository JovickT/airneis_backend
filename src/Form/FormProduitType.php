<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Marques;
use App\Entity\Produits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('nom')
            ->add('prix')
            ->add('description')
            ->add('quantite')
            ->add('date_creation', null, [
                'widget' => 'single_text',
            ])
            ->add('marque', EntityType::class, [
                'class' => Marques::class, // Remplacez Marque::class par votre entité de marque
                'choice_label' => 'nom', // Le champ de l'entité à afficher dans la liste déroulante
                'placeholder' => 'Choisir une marque', // Optionnel : message affiché par défaut
                'attr' => ['class' => 'form-control'] // Classes CSS supplémentaires
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categories::class, // Remplacez Categorie::class par votre entité de catégorie
                'choice_label' => 'nom', // Le champ de l'entité à afficher dans la liste déroulante
                'placeholder' => 'Choisir une catégorie', // Optionnel : message affiché par défaut
                'attr' => ['class' => 'form-control'] // Classes CSS supplémentaires
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
