<?php

namespace App\Form;

use App\Entity\Donor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DonorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'firstNameInput'],
               'attr' => ['class' => 'form-control', 'id' => 'firstNameInput'],
            ])
            ->add('lastName', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'lastName'],
               'attr' => ['class' => 'form-control', 'id' => 'lastName'],
            ])
            ->add('email', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'email'],
               'attr' => ['class' => 'form-control', 'id' => 'email'],
            ])
            ->add('mobile', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'mobile'],
               'attr' => ['class' => 'form-control', 'id' => 'mobile'],
            ])
            ->add('address', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'address'],
               'attr' => ['class' => 'form-control', 'id' => 'address'],
            ])
            ->add('zipCode', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'zipCode'],
               'attr' => ['class' => 'form-control', 'id' => 'zipCode'],
            ])
            ->add('city', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'city'],
               'attr' => ['class' => 'form-control', 'id' => 'city'],
            ])
            ->add('country', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'country'],
               'attr' => ['class' => 'form-control', 'id' => 'country'],
            ])
            ->add('dons', CollectionType::class, [
              'entry_type' => DonType::class,
              'entry_options' => ['label' => false],
              'allow_add' => true,

            ])
                ->add('save', SubmitType::class, ['label' => 'Create']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Donor::class,
        ]);
    }
}
