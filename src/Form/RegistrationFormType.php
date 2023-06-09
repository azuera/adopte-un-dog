<?php

namespace App\Form;

use App\Entity\Department;
use App\Entity\User;
use App\Repository\DepartmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $data = $options['data'] ?? null;
        $builder
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('email', EmailType::class, ['label' => 'E-mail']);
        if (!is_null($data) && is_null($data->getId())) {
            $builder
                ->add('plainPassword', PasswordType::class, [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'mapped' => false,
                    'label' => 'Mot de passe',
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
                ]);
        } else {
            // Only for change and application
            $builder
                ->add('phone', NumberType::class, ['label' => 'Téléphone'])
                ->add('location', TextType::class, ['label' => 'Ville'])
                ->add('department', EntityType::class, [
                    'label' => 'Département',
                    'required' => false,
                    'class' => Department::class,
                    'query_builder' => function (DepartmentRepository $er) {
                        return $er->createQueryBuilder('d')->orderBy('d.name', 'ASC');
                    },
                    'choice_label' => 'name',
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['Default'],
        ]);
    }
}
