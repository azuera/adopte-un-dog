<?php

namespace App\Controller\Admin;

use App\Entity\Dog;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Validator\Constraints\Collection;

class DogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dog::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id') ->hideOnForm(),
            TextField::new('name'),
            BooleanField::new('is_adopted'),
            TextField::new('description'),
            TextField::new('history'),
            TextField::new('sociability'),
            BooleanField::new('is_lof'),
            AssociationField::new('breeds')
            ->onlyOnForms()
            ->setFormTypeOptions(['by_reference' => false ]) ,

        ];
    }
}
