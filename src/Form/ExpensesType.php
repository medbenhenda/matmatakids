<?php

namespace App\Form;

use App\Entity\Expenses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpensesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choicesTypes = ['Depences en France' => 'Depences en France' , 'Depences en Tunsie' => 'Depences en Tunsie'];
        $choicesCategories = ['Achats de marchandises' => 'Achats de marchandises',
            'Fournitures d\'entretien et fournitures de petit équipement' => 'Fournitures d\'entretien et fournitures de petit équipement',
            'Eau, Gaz, électricité' => 'Eau, Gaz, électricité',
            'Fournitures administratives' => 'Fournitures administratives' ,
            'Autres fournitures' => 'Autres fournitures',
            'Charges locatives et de copropriété' => 'Charges locatives et de copropriété',
            'Locations' => 'Locations',
            'Entretiens et réparations' => 'Entretiens et réparations',
            'Déplacements, missions, réceptions' => 'Déplacements, missions, réceptions',
            'Frais postaux et de télécommunications' => 'Frais postaux et de télécommunications',
            'Services bancaires' => 'Services bancaires',
            'Impôts, taxes et versements assimilés' => 'Impôts, taxes et versements assimilés',
            'Salaires et charges sociales' => 'Salaires et charges sociales',
            'Aides financières octroyées' => 'Aides financières octroyées',
            'Amendes, pénalités' => 'Amendes, pénalités',
            'Matériel de bureau et matériel informatique' => 'Matériel de bureau et matériel informatique',
            'Mobilier' => 'Mobilier',
            'Autres investissements' => 'Autres investissements',
            ];
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control js-datepicker'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
                'html5' => false,
            ])
            ->add('title', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('description', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('clientName', null, [
                'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
                'attr' => ['class' => 'form-control', 'id' => 'type'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('category', ChoiceType::class, [
                'choices' => $choicesCategories,
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => $choicesTypes,
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('invoice', CollectionType::class, [
                'entry_type' => DocumentType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,

            ])
            ->add('save', SubmitType::class, ['label' => 'Save']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Expenses::class,
        ]);
    }
}
