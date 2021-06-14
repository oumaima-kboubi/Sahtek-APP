<?php

namespace App\Controller\Admin;

use App\Entity\Entreprise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EntrepriseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Entreprise::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),
            TextField::new('description'),
//            ImageField::new('featured_image')->setFormType(VichImageType::class)
//                ->setBasePath($this->getParameter("app.path.featured_images"))
//                ->onlyOnIndex(),
//                ->setValue("null"),
//            TextAreaField::new('imageFile')
//                ->setFormType(VichImageType::class)
//                ->hideOnIndex()
//                ->setFormTypeOption('allow_delete',false),
//            ->setUploadDir("/uploads/images/featured"),
        ];
    }

}
