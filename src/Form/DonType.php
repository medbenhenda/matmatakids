<?php

namespace App\Form;

use App\Entity\Don;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class DonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', MoneyType::class, [
                'divisor' => 1,
                'label' => ' Amount ',
                'currency' => 'EUR',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('isProfessional', CheckboxType::class, [
                'label' => ' Professionnel? ',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control js-datepicker'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
                'html5' => false,
                'format' => 'YYYY-MM-dd'
            ])
            ->add('type', null, [
                'label_attr' => ['class' => 'text-sm-left', ],
                'attr' => ['class' => 'form-control', ],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('project', null, [
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Don::class,
        ]);
    }
}
