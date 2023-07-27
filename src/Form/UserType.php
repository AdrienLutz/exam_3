<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
//        $builder->get('roles')
//            ->addModelTransformer(new CallbackTransformer(
//                fn ($rolesAsArray) => count($rolesAsArray) ? $rolesAsArray[0]: null,
//                fn ($rolesAsString) => [$rolesAsString]
//            ));

        $builder
            ->add('email')
//            ->add('roles')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('photo')
            ->add('secteur')
            ->add('contrat')
            ->add('date_sortie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection'=> true
        ]);
    }
}
