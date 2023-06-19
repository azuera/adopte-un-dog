<?php

namespace App\Controller\Admin;

use App\Entity\Breeder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BreederCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Breeder::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
            TextField::new('plainPassword')->onlyOnForms(),
            TextField::new('name'),
            TextField::new('phone'),
            AssociationField::new('department')
                ->onlyOnForms()
                ->setFormTypeOptions(['by_reference' => false]),
                BooleanField::new('is_admin'),

        ];
    }
}