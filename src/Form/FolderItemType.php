<?php

namespace App\Form;

use App\Entity\FolderItem;
use App\Entity\Folder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;

class FolderItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
              'label_attr' => ['class' => 'text-sm-left',],
              'attr' => ['class' => 'form-control', ],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('lastName', null, [
              'label_attr' => ['class' => 'text-sm-left', ],
              'attr' => ['class' => 'form-control',],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('birthdate', null, [
              'widget' => 'single_text',
              'label_attr' => ['class' => 'text-sm-left'],
              'attr' => ['class' => 'form-control js-datepicker'],
              'row_attr' => ['class' => 'col-md-6 mb-3', ],
              'html5' => false,
              'format' => 'dd/mm/YYYY'

            ])
            ->add('handicapped', CheckboxType::class, [
              'data' => true,
              'label_attr' => ['class' => 'form-check-label'],
              'attr' => ['class' => 'form-check-input is-invalid ',],
              'row_attr' => ['class' => 'form-group', ],
              'required' => false
            ])
            ->add('unhealthy', CheckboxType::class, [
              'data' => true,
              'label_attr' => ['class' => 'form-check-label'],
              'attr' => ['class' => 'form-check-input is-invalid ',],
              'row_attr' => ['class' => 'form-group', ],
              'required' => false
            ])
            ->add('orphan', CheckboxType::class, [
              'data' => true,
              'label_attr' => ['class' => 'form-check-label'],
              'attr' => ['class' => 'form-check-input is-invalid ',],
              'row_attr' => ['class' => 'form-group', ],
              'required' => false
            ])
            ->add('schoolboy', CheckboxType::class, [
              'data' => true,
              'label_attr' => ['class' => 'form-check-label'],
              'attr' => ['class' => 'form-check-input is-invalid ',],
              'row_attr' => ['class' => 'form-group', ],
              'required' => false
            ])
            ->add('description', null, [
              'label_attr' => ['class' => 'text-sm-left'],
              'attr' => ['class' => 'form-control'],
              'row_attr' => ['class' => 'col-md-12 mb-3', ],
              'required' => false
            ])
            ->add('address', null, [
              'label_attr' => ['class' => 'text-sm-left'],
              'attr' => ['class' => 'form-control'],
              'row_attr' => ['class' => 'col-md-12 mb-3', ],
              'required' => false
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
            ])
            ->add('save', SubmitType::class, ['label' => 'Add']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FolderItem::class,
            'folder' => null,
        ]);
    }
}
