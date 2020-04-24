<?php

namespace App\Form;

use App\Entity\Folder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FolderType extends AbstractType
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
            ->add('mobile', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
              'attr' => ['class' => 'form-control', 'id' => 'type'],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('address', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
              'attr' => ['class' => 'form-control', 'id' => 'type'],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('details', null, [
              'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
              'attr' => ['class' => 'form-control', 'id' => 'type'],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('proof', CollectionType::class, [
              'entry_type' => DocumentType::class,
              'entry_options' => ['label' => false],
              'allow_add' => true,
               'by_reference' => false,

            ])
            ->add('save', SubmitType::class, ['label' => 'Create']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Folder::class,
        ]);
    }
}
