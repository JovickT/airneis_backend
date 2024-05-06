<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
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
            ->add('mot_de_passe', PasswordType::class)
            ->add('telephone', null, [
                'required' => false
            ])
            ->add('role', null, [
                'attr' => [
                    'name' => 'role',
                ],
            ])
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
