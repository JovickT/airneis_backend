<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', null, [
                'attr' => [
                    'name' => 'prenom',
                ],
            ])
            ->add('nom', null, [
                'attr' => [
                    'name' => 'nom',
                ],
            ])
            ->add('email', null, [
                'attr' => [
                    'name' => 'email',
                ],
            ])
            ->add('mot_de_passe', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('telephone', null, [
                'required' => false
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'ROLE_USER' => 'ROLE_USER',
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    // Ajoutez d'autres choix au besoin
                ],
                'multiple' => true,
                'expanded' => false, // Définissez à true si vous voulez une sélection multiple
                'attr' => [
                    'class' => 'form-control', // Ajoutez des classes CSS personnalisées au besoin
                    // Autres attributs HTML personnalisés
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('adresse', FormAdresseType::class)
            ->add('save', SubmitType::class, ['label' => 'Ajouter'])
            ->add('adresse', FormAdresseType::class)
            ->add('save', SubmitType::class, ['label' => 'Ajouter'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
