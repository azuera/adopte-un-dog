<?php

namespace App\Form;

use App\Entity\Application;
use App\Entity\Dog;
use App\Repository\DogRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $offer = $options['data']->getOffer();
        $builder
            ->add('dogs', EntityType::class, [
                'class' => Dog::class,
                'query_builder' => function (DogRepository $request) use ($offer) {
                    return $request->createQueryBuilder('d')
                        ->leftJoin('d.offer', 'o')
                        ->andWhere('d.isAdopted = false')
                        ->andWhere('o.id = :id')
                        ->setParameter('id', $offer->getId())
                        ->orderBy('d.name', 'ASC');
                },
                'choice_label' => 'name',
                'required' => false,
                'label' => 'Chiens',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('messages', CollectionType::class, [
                'label' => false,
                'entry_type' => MessageType::class,
                'entry_options' => ['label' => false],
            ])
            ->add('user', RegistrationFormType::class, [
                'label' => 'Vos informations',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}
