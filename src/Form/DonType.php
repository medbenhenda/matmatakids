<?php

namespace App\Form;

use App\Entity\Don;
use Symfony\Component\Form\AbstractType;
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
            ->add('date', null, [
              'widget' => 'single_text',
              'label_attr' => ['class' => 'text-sm-left'],
              'attr' => ['class' => 'form-control js-datepicker'],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
              'html5' => false,
              'format' => 'dd/mm/YYYY'
            ])
            ->add('type', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
              'attr' => ['class' => 'form-control', 'id' => 'type'],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('Project', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'Project'],
              'attr' => ['class' => 'form-control', 'id' => 'Project'],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('reciepe', CheckboxType::class, [
              'data' => true,
              'label_attr' => ['class' => 'form-check-label'],
              'attr' => ['class' => 'form-check-input is-invalid ',],
              'row_attr' => ['class' => 'form-group', ],
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
