<?php

namespace App\Form;

use App\Entity\Don;
use App\Entity\Donor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DonateType extends AbstractType
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
            ->add('date', DateType::class, [
               'widget' => 'single_text',
               'label_attr' => ['class' => 'text-sm-left'],
               'attr' => ['class' => 'form-control js-datepicker'],
               'row_attr' => ['class' => 'col-md-6 mb-3', ],
               'html5' => false,
               'format' => 'dd/mm/YYYY'
            ])
            ->add('type', null, [
              'label_attr' => ['class' => 'text-sm-left'],
              'attr' => ['class' => 'form-control'],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('Project', null, [
              'label_attr' => ['class' => 'text-sm-left'],
              'attr' => ['class' => 'form-control'],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('reciepe', CheckboxType::class, [
              'data' => true,
              'label_attr' => ['class' => 'form-check-label'],
              'attr' => ['class' => 'form-check-input is-invalid ',],
              'row_attr' => ['class' => 'form-group', ],
            ])
            ->add('donor', EntityType::class, [
              'class' => Donor::class,
              'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('u')
                      ->orderBy('u.firstName', 'ASC');
              },
              'label_attr' => ['class' => 'text-sm-left'],
              'attr' => ['class' => 'form-control',],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Create']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Don::class,
        ]);
    }
}
