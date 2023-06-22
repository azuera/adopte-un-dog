<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Dog;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DogsImagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options, ): void
    {
        $builder
            ->add(
                'imageFile', VichImageType::class,
                [
                    'label' => 'Image',
                    'required' => true,
                    'asset_helper' => true,
                ]
            )
            ->add('dog', EntityType::class, [
                'class' => Dog::class,
                'label' => 'Chien',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}