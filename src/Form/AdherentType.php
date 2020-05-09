<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('lastName', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])

            ->add('email', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('address', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('zipCode', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('city', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('country', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('inscriptionDate', null, [
                'widget' => 'single_text',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control js-datepicker'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
                'html5' => false,
            ])
            ->add('expirationDate', null, [
                'widget' => 'single_text',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control js-datepicker'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
                'html5' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
