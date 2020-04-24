<?php

namespace App\Form;

use App\Entity\Affectation, App\Entity\Folder, App\Entity\Sponsor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AffectationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('amount', null, [
            'label_attr' => ['class' => 'text-sm-left', 'for' => 'type'],
            'attr' => ['class' => 'form-control', 'id' => 'type'],
            'row_attr' => ['class' => 'col-md-6 mb-3', ],
        ])
        ->add('startDate', null, [
            'widget' => 'single_text',
            'label_attr' => ['class' => 'text-sm-left'],
            'attr' => ['class' => 'form-control js-datepicker'],
            'row_attr' => ['class' => 'col-md-6 mb-3', ],
            'html5' => false,
            'format' => 'dd/mm/YYYY'
        ])
        ->add('endDate', null, [
            'widget' => 'single_text',
            'label_attr' => ['class' => 'text-sm-left'],
            'attr' => ['class' => 'form-control js-datepicker'],
            'row_attr' => ['class' => 'col-md-6 mb-3', ],
            'html5' => false,
            'format' => 'dd/mm/YYYY'
        ])
        ->add('folder', EntityType::class,[
            'class' => Folder::class,
            'row_attr' => ['class' => 'col-md-6 mb-3', ],
            'label_attr' => ['class' => 'text-sm-left'],
            'data' => $options['folder'],
            'query_builder' => function (EntityRepository $er) use ($options) {
                $qb =  $er->createQueryBuilder('f');
                if ($options['folder']) {
                    $qb->where('f.id = :id')
                    ->setParameter('id', $options['folder']->getid());
                }
                return $qb;
            },
            //'preferred_choices' => $options['folder'] ? $options['folder']->getId() : [],
        ])
        ->add('sponsor', EntityType::class,[
            'class' => Sponsor::class,
            'row_attr' => ['class' => 'col-md-6 mb-3', ],
            'label_attr' => ['class' => 'text-sm-left'],
            'data' => $options['sponsor'],
            'query_builder' => function (EntityRepository $er) use ($options) {
                $qb =  $er->createQueryBuilder('s');
                if ($options['sponsor']) {
                    $qb->where('s.id = :id')
                    ->setParameter('id', $options['sponsor']->getid());
                }
                return $qb;
            },
            //'preferred_choices' => $options['sponsor'] ? $options['sponsor']->getId() : [],
        ])
        ->add('save', SubmitType::class, ['label' => 'Affect']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Affectation::class,
            'folder' => null,
            'sponsor' => null,
        ]);
    }
}
