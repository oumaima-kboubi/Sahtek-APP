<?php

namespace App\Controller\Admin;

use App\Entity\Belong;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BelongCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Belong::class;
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
