<?php

namespace App\Form;

use App\Entity\CareTakerOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CareTakerOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt',null,array(
        'widget' => 'choice',
        'years' => range(1900, 2500),
    ))
            ->add('startTime',null,array(
                'widget' => 'choice',
                'years' => range(1900, 2500),
            ))
            ->add('finishTime',null,array(
                'widget' => 'choice',
                'years' => range(1900, 2500),
            ))
            ->add('price')
            ->add('approved')
            ->add('Pending')
            ->add('deleted')
            ->add('caretaker')
            ->add('day')
           // ->add('pharmacy')
            ->add('client')
            ->add('Hire!', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CareTakerOrder::class,
        ]);
    }
}
