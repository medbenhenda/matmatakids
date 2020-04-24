<?php

namespace App\Form;

use App\Entity\Sponsor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SponsorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
              'label_attr' => ['class' => 'text-sm-left', ],
              'attr' => ['class' => 'form-control',],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('lastName', null, [
              'label_attr' => ['class' => 'text-sm-left',],
              'attr' => ['class' => 'form-control',],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('address', null, [
              'label_attr' => ['class' => 'text-sm-left',],
              'attr' => ['class' => 'form-control',],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('zipCode', null, [
              'label_attr' => ['class' => 'text-sm-left',],
              'attr' => ['class' => 'form-control',],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('city', null, [
              'label_attr' => ['class' => 'text-sm-left',],
              'attr' => ['class' => 'form-control',],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('country', null, [
              'label_attr' => ['class' => 'text-sm-left', ],
              'attr' => ['class' => 'form-control', ],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('mobile', null, [
              'label_attr' => ['class' => 'text-sm-left',],
              'attr' => ['class' => 'form-control', ],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('email', null, [
              'label_attr' => ['class' => 'text-sm-left'],
              'attr' => ['class' => 'form-control', ],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Create']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sponsor::class,
        ]);
    }
}
