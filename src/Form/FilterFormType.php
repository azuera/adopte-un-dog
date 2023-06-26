<?php

namespace App\Form;

use App\Entity\Breed;
use App\Repository\BreedRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('breed', EntityType::class, [
                'label' => 'Race',
                'class' => Breed::class,
                'query_builder' => function (BreedRepository $er) {
                    return $er->createQueryBuilder('b')->orderBy('b.name', 'ASC');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('LOF', CheckboxType::class,
                [
                    'label' => 'LOF',
                    'required' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Filter::class,
        ]);
    }
}
