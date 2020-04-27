<?php

namespace App\Form;

use App\Entity\Affectation;
use App\Entity\ProposingTransaction;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Sponsor;
use App\Entity\Folder;
use App\Entity\User;

class ProposingTransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $months = ['Janvier' => 1, 'Février'=> 2, 'Mars' => 3, 'Avril' => 4, 'Mai' => 5, 'Juin' => 6, 'Juillet' => 7,
            'Août' => 8, 'septembre' => 9, 'Octobre' => 10, 'Novembre' => 11, 'Décembre' => 12];

        $builder
            ->add('affectation', EntityType::class, [
                'class' => Affectation::class,
                'row_attr' => ['class' => 'col-md-6 mb-3 d-none', ],
                'label_attr' => ['class' => 'text-sm-left'],
                'data' => $options['affectation'],
                'choices' => [$options['affectation']],
            ])
            ->add('responsible', EntityType::class, [
                'class' => User::class,
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
                'label_attr' => ['class' => 'text-sm-left'],
                'query_builder' => function (EntityRepository $er) {
                    $qb =  $er->createQueryBuilder('u');
                    return $qb;
                },
            ])
            ->add('transactionDate', null, [
                'widget' => 'single_text',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control js-datepicker'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
                'html5' => false,
                'format' => 'dd/mm/YYYY'
            ])
            ->add('amount', MoneyType::class, [
                'divisor' => 1,
                'label' => ' Amount ',
                'currency' => 'EUR',
                'label_attr' => ['class' => 'text-sm-left'],
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'col-md-6 mb-3', ],
            ])
            ->add('month', ChoiceType::class, [
                'choices'  => $months,
            ])
            ->add('year', ChoiceType::class, [
                'choices'  => self::setYears(),
            ])
            ->add('save', SubmitType::class, ['label' => 'Add'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProposingTransaction::class,
            'affectation' => null,
        ]);
    }

    /**
     * @return array
     */
    private static function setYears(): array
    {
        $years = [];
        $begin = new \DateTime();
        $end = new \DateTime();
        $end = $end->modify('+5 year');
        $interval = new \DateInterval('P1Y');
        $daterange = new \DatePeriod($begin, $interval, $end);
        foreach ($daterange as $date) {
            $years[$date->format('Y')] = $date->format('Y');
        }

        return $years;
    }
}
