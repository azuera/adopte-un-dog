<?php

namespace App\Controller\Admin;

use App\Entity\Application;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ApplicationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Application::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user')
            ->onlyOnForms()
            ->setFormTypeOptions(['by_reference' => false ]) ,

            AssociationField::new('offer') 
            ->onlyOnForms()
            ->setFormTypeOptions(['by_reference' => false ]) ,
            
            AssociationField::new('dogs')
            ->onlyOnForms()
            ->setFormTypeOptions(['by_reference' => false ]) ,
            DateTimeField::new('date_time'),
        
        ];
    }
    
}
