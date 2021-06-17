<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password')


//            ->add('roles')
            //->add('password')
//            ->add('isVerified')
//            ->add('createdAt')
//            ->add('updatedAt')
            //->add('firstName')
//            ->add('lastName')
//            ->add('email')
//            ->add('birthDate')
//            ->add('CIN')
            //  ->add('solde')
//            ->add('featured_image')
//            ->add('city')
//            ->add('gender')
//            ->add('featured_image', FileType::class, array(
//                'mapped' => false,
//                'required' => false,
//                'constraints' => array(
//                    new \Symfony\Component\Validator\Constraints\Image()
//                )
//            ))
//            ->add('role')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
