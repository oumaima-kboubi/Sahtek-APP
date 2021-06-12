<?php

namespace App\Controller\Admin;

use App\Entity\DrugOrder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DrugOrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DrugOrder::class;
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
