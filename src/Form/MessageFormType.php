<?php

// src/Form/MessageFormType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'A:',
                'attr' => ['readonly' => true]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message:',
                'attr' => ['readonly' => true]
            ])
            ->add('response', TextareaType::class, [
                'label' => 'Réponse:'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
