<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $optionsPosition = [
            'Président' => 'Président',
            'Vice président' => 'Vice président',
            'Trésorier' => 'Trésorier',
            'Secrétaire' => 'Secrétaire',
            'Commissaire aux comptes' => 'Commissaire aux comptes',
            'Animateurs' => 'Animateurs',
            'Formateurs' => 'Formateurs',
            'Gestion des ressources humaines' => 'Gestion des ressources humaines',
            'Communication' => 'Communication',
            'Logistique' => 'Logistique',
            'DSI' => 'DSI',
        ];

        $builder
            ->add('email', EmailType::class, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
                'empty_data' => true,
            ]);

        if ($options['action'] == 'new') {
            $builder->add('password', PasswordType::class, [
                'empty_data' => true,
                'always_empty' => true,
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ]);
        }

        $builder->add('roles', ChoiceType::class, [
            'choices' => ['Admin' => 'ROLE_ADMIN', 'Simple user' => 'ROLE_USER'],
            'label' => 'Rôle',
            'label_attr' => ['class' => 'text-sm-left',],
            'attr' => ['class' => 'form-control',],
            'row_attr' => ['class' => 'col-md-6 mb-3',],
        ])
            ->add('firstName', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('lastName', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('mobile', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('address', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('zipCode', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('city', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('country', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('position', ChoiceType::class, [
                'choices' => $optionsPosition,
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ])
            ->add('isActive', null, [
                'label_attr' => ['class' => 'text-sm-left',],
                'attr' => ['class' => 'form-control',],
                'row_attr' => ['class' => 'col-md-6 mb-3',],
            ]);
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesAsArray) {
                    // transform the array to a string
                    return implode(', ', $rolesAsArray);
                },
                function ($rolesAsString) {
                    // transform the string back to an array
                    return explode(', ', $rolesAsString);
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'action' => null,
        ]);
    }
}
