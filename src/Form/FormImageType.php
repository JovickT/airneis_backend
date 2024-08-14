<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FormImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'attr' => [
                    'name' => 'nom',
                ],
            ]);
    
        // Vérifier si on est en mode édition ou ajout
        if (!$options['is_edit']) {
            // Ajouter le champ image seulement si on n'est pas en mode édition
            $builder->add('image', FileType::class, [
                'label' => 'Image (JPEG, PNG file)',
                'multiple' => true,
                'mapped' => false,
                'required' => true,
                'attr' => [
                    'onchange' => 'previewImage(event)',
                ],
            ]);
        }
    
        // Ajout du bouton de soumission
        $builder->add('save', SubmitType::class, [
            'label' => $options['is_edit'] ? 'Modifier' : 'Ajouter',
            'attr' => ['class' => 'btn-block btn-primary col-sm-6 mt-2'],
        ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,  // votre entité liée au formulaire
            'is_edit' => false,  // Par défaut, ce n'est pas en mode édition
        ]);
    }
}
