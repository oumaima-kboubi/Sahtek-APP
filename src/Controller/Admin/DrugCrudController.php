<?php

namespace App\Controller\Admin;

use App\Entity\Drug;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DrugCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Drug::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('Name'),
            NumberField::new('price'),
            TextEditorField::new('description'),
           // TextField::new('featured_image')->setFormType(VichImageType::class),
            AssociationField::new('type')->autocomplete(),
            AssociationField::new('entreprise')->autocomplete(),
         //   TextAreaField::new('imageFile')->setFormType(VichImageType::class),
        ];
    }

}
