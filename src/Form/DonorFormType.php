<?php

namespace App\Form;

use App\Entity\Donor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
                'attr' => ['class' => 'form-control',],
            ])
            ->add('lastName', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
                'attr' => ['class' => 'form-control',],
            ])
            ->add('email', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
                'attr' => ['class' => 'form-control',],
            ])
            ->add('mobile', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
                'attr' => ['class' => 'form-control',],
            ])
            ->add('address', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
                'attr' => ['class' => 'form-control',],
            ])
            ->add('zipCode', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
                'attr' => ['class' => 'form-control',],
            ])
            ->add('city', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
                'attr' => ['class' => 'form-control',],
            ])
            ->add('country', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
                'attr' => ['class' => 'form-control',],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Donor::class,
        ]);
    }
}
