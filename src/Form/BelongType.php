<?php

namespace App\Form;

use App\Entity\Belong;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BelongType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity')
            ->add('Promotion')
            ->add('InitialPrice')
            ->add('finalPrice')
            ->add('pourcentage')
            ->add('drug')
            ->add('Pharmacy')
            ->add('Add Drug To My List', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Belong::class,
        ]);
    }
}
