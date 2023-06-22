<?php
namespace App\Form;

use App\Entity\Dog;
use App\Entity\Breed;
use App\Form\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('breeds', EntityType::class, [
                'label' => 'Race',
                'class' => Breed::class,
                'multiple' => true,
                'expanded' => false,
                'choice_label' => 'name',
                'required' => false,
                'attr' => [
                    'class' => 'tom-select',
                ],
            ])
            ->add('isLOF', CheckboxType::class, [
                'label' => 'Chien LOF',
                'required' => false,
            ])
            ->add('history', TextareaType::class, [
                'label' => 'Historique',
                'required' => true,
            ])
            ->add('sociability', TextareaType::class, [
                'label' => 'Sociabilité',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
            ])
            ->add('isAdopted', CheckboxType::class, [
                'label' => 'Adopté',
                'required' => false,
            ])
            ->add('images', CollectionType::class,[
                'entry_type'=> ImageType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference'  => false,
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