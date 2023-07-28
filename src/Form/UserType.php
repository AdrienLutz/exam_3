<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
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

            ->add('nom', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])

            ->add('prenom', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])

            ->add('photo', FileType::class, [
                "attr" => [
                    "class" => "form-control"
                ],
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid format (png, jpg)',
                    ])
                ],
            ])


            ->add('secteur', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])

            ->add('contrat', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])

            ->add('date_sortie')

//            ->add('valider', SubmitType::class, [
//                "attr" => [
//                    "class" => "btn btn-success"
//                ]
//            ])
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
