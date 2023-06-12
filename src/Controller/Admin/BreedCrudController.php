<?php

namespace App\Controller\Admin;

use App\Entity\Breed;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BreedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Breed::class;
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
