<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('email')

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,


                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([
//                        'pattern' => '/^(?=.[A-Za-z])(?=.\d).{8,}$/',
                        'pattern' => '/(?=\S*[a-z])(?=\S*\d)/',
//                        'pattern' => '/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9!@#$%^&*()_]+){8,20}$"/',
                        'message' => 'Your password should contain at least 1 number and 1 letter',
                    ]),
                ],
            ])

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
                'mapped' => false,
                'required' => false,
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

//            ->add('secteur', TextType::class, [
//                "attr" => [
//                    "class" => "form-control",
//                        ]
//            ])

//            ->add('contrat', TextType::class, [
//                "attr" => [
//                    "class" => "form-control"
//                ]
//            ])

            ->add('secteur', ChoiceType::class,[
                'choices' => [
                    'RH' => 'rh',
                    'Informatique' => 'info',
                    'Comptabilité' => 'compta',
                    'Direction' => 'dir',
                ]
            ])

            ->add('contrat', ChoiceType::class,[
                'choices' => [
                    'CDI' => 'cdi',
                    'CDD' => 'cdd',
                    'Interim' => 'interim',
                ]
            ])




//            ->add('date_sortie', DateType::class,[
//                "attr" => [
//                    "class" => "form-control"
//                ]
//            ])

            ->add('date_sortie')

            ->add('valider', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-success"
                ]
            ])
        ;

//        if ('choices' == 'cdi'){
////                $builder->add('date_sortie', disabledType::class, [
//            $builder->add('date_sortie', HiddenType::class, [
//                'disabled' => 'disabled',
//            ]);
//        }

        if('choices' =='cdi'){
            $builder->remove('date_sortie');
        }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection'=> true
        ]);
    }
}
