<?php

namespace App\Form;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Validator\Constraints\PasswordMatch;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AdminRegistrationFormType extends AbstractType
{
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
    
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
            ]);
    
        if ($options['is_new']) {
            $builder->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de Passe'],
                'second_options' => ['label' => 'Vérification du Mot de Passe'],
                'constraints' => [
                    new Assert\NotBlank(['groups' => ['registration']]),
                    new Assert\Callback([
                        'callback' => [$this, 'validatePassword'],
                        'groups' => ['registration'],
                    ]),
                ],
            ]);
        }
    
        $builder
        
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
            ])
            ->add('save', SubmitType::class, ['label' => 'Ajouter']);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
            'csrf_protection' => false, // Désactive la protection CSRF
            'is_new' => false, // Définir la valeur par défaut de l'option
            'validation_groups' => function (FormInterface $form) {
                $data = $form->getData();
                return $data->getEmail() ? ['Default'] : ['Default', 'registration'];
            }
        ]);
    }

    public function validatePassword($value, ExecutionContextInterface $context)
    {
        $form = $context->getRoot();
        $admin = $form->getData();

        // Si l'utilisateur est en cours de modification et le champ de mot de passe est vide,
        // récupérez le mot de passe actuel de l'utilisateur dans la base de données
        if ($admin->getEmail() && empty($value)) {
            $oldAdmin = $this->adminRepository->find($admin->getEmail());
            $admin->setPassword($oldAdmin->getPassword());
        }
    }
}
