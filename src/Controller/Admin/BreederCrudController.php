<?php

namespace App\Controller\Admin;

use App\Entity\Breeder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BreederCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Breeder::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
