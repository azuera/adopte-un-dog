<?php
namespace App\Form;

use App\Entity\Dog;
use App\Entity\Breed;
use App\Repository\BreedRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isLOF', CheckboxType::class, ['label' => 'Chien LOF', 'required' => false,])
            ->add('isAdopted', CheckboxType::class, ['label' => 'Adopté', 'required' => false,])
            ->add('history', TextareaType::class, ['label' => 'Historique','required' => true,])
            ->add('sociability', TextareaType::class, ['label' => 'Sociabilité','required' => true,])
            ->add('name', TextareaType::class, ['label' => 'Nom','required' => true,])
            ->add('description', TextareaType::class, ['label' => 'Description','required' => true,])
            ->add('breeds', EntityType::class, [
                'label' => 'Race',
                'class' => Breed::class,
                'multiple' => true ,
                'expanded' => false ,
                'choice_label' => 'name',
                'required' => false,
            ])
        ;
        
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}