<?php

namespace App\Form;

use App\Entity\Beneficiary;
use App\Entity\Folder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeneficiaryType extends AbstractType
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
            ->add('birthdate', BirthdayType::class, [
                'widget' => 'single_text',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control js-datepicker'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
                'html5' => false,
            ])
            ->add('phone', null, [
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
                'row_attr' => ['class' => 'col-md-4 mb-3', ],
            ])
            ->add('city', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-4 mb-3', ],
            ])
            ->add('country', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-4 mb-3', ],
            ])
            ->add('schoolLevel', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('isOrphan', CheckboxType::class, [
                'label_attr' => ['class' => 'form-check-label'],
                'attr' => ['class' => 'form-check-input is-invalid ',],
                'row_attr' => ['class' => 'form-group', ],
                'required' => false
            ])
            ->add('isHandicapped', CheckboxType::class, [
                'label_attr' => ['class' => 'form-check-label'],
                'attr' => ['class' => 'form-check-input is-invalid ',],
                'row_attr' => ['class' => 'form-group', ],
                'required' => false
            ])
            ->add('isUnhealty', CheckboxType::class, [
                'label_attr' => ['class' => 'form-check-label'],
                'attr' => ['class' => 'form-check-input is-invalid ',],
                'row_attr' => ['class' => 'form-group', ],
                'required' => false
            ])
            ->add('isSchoolBoy', CheckboxType::class, [
                'label_attr' => ['class' => 'form-check-label'],
                'attr' => ['class' => 'form-check-input is-invalid ',],
                'row_attr' => ['class' => 'form-group', ],
                'required' => false
            ])
            ->add('particularCase', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('favoriteActivity', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('haveAFolder', CheckboxType::class, [
                'label_attr' => ['class' => 'form-check-label'],
                'attr' => ['class' => 'form-check-input is-invalid ',],
                'required' => false
            ])

            ->add('folder', EntityType::class, [
                'class' => Folder::class,
                'choice_label' => function ($folder) {
                    return $folder->getDisplayedName();
                },
                'required'   => false,
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('project', null, [
                'empty_data' => [],
                'required'   => false,
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Beneficiary::class,
        ]);
    }
}
