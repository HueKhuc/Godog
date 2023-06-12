<?php

namespace App\Controller\Admin;

use App\Entity\Adopter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdopterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adopter::class;
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
