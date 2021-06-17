<?php

namespace App\Form;

use App\Entity\DrugOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DrugOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price')
            ->add('quantity')
            ->add('Approved')
            ->add('featured_image', FileType::class, array(
                'mapped' => false,
                'required' => false,
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\Image()
                )
            ))
            ->add('pending')
            ->add('description')
            ->add('day')
            ->add('deleted')
            ->add('Drug')
            ->add('client')
            ->add('pharmacy')
            ->add('Order Drug', SubmitType::class)



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DrugOrder::class,
        ]);
    }
}
