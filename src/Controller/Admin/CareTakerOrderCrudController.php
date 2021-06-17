<?php

namespace App\Controller\Admin;

use App\Entity\CareTakerOrder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class CareTakerOrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CareTakerOrder::class;
    }

//
//    public function configureFields(string $pageName): iterable
//    {
//        return [
//            TimeField::new('day'),
//            TimeField::new('startTime'),
//            TimeField::new('finishTime'),
//            TextEditorField::new('description'),
//        ];
//    }

}
