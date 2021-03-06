<?php

namespace App\Form;

use App\Entity\Subvention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entreprise', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('entrepriseAddress', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('entrepriseEmail', EmailType::class, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-4 mb-3',],
            ])
            ->add('entreprisePhone1', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-4 mb-3',],
            ])
            ->add('entreprisePhone2', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-4 mb-3',],
            ])
            ->add('subject', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('description', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control', 'rows' => 8,],
                'row_attr' => ['class' => 'col-md-12 mb-3',],
            ])
            ->add('depositeDate', DateType::class, [
                'widget' => 'single_text',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control js-datepicker'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
                'html5' => false,
                'format' => 'YYYY-MM-dd'
            ])
            ->add('documents', CollectionType::class, [
                'entry_type' => DocumentType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'label' => false,
                'by_reference' => false,

            ])
            //->add('save', SubmitType::class, ['label' => 'Save']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subvention::class,
        ]);
    }
}
