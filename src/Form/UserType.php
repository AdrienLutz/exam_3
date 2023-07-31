<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('email', EmailType::class,[
                'attr' => [
                'placeholder' => "Veuillez saisir un email",
                ],
            ])

            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => [
                    'placeholder' => "Veuillez saisir un mot de passe avec 8 caractères, 1 chiffre et 1 lettre",
                    'autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/(?=\S*[a-z])(?=\S*\d)/',
                        'message' => 'Your password should contain at least 1 number and 1 letter',
                    ]),
                ],
            ])

            ->add('nom', TextType::class, [
                "attr" => [
                    'placeholder' => "Veuillez saisir un nom",
                    "class" => "form-control"
                ]
            ])

            ->add('prenom', TextType::class, [
                "attr" => [
                    'placeholder' => "Veuillez saisir un prénom",
                    "class" => "form-control"
                ]
            ])

            ->add('photo', FileType::class, [
                "attr" => [
                    'placeholder' => "Veuillez uploader une photo",
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

            ->add('secteur', ChoiceType::class,[
                "attr" => [
                    'placeholder' => "Veuillez saisir un secteur",
                    "class" => "form-control"
                ],
                'choices' => [
                    'RH' => 'rh',
                    'Informatique' => 'info',
                    'Comptabilité' => 'compta',
                    'Direction' => 'dir',
                ]
            ])

            ->add('contrat', ChoiceType::class,[
                "attr" => [
                    'placeholder' => "Veuillez saisir un type de contrat (CDI, CDD, interim",
                    "class" => "form-control"
                ],
                'choices' => [
                    'CDI' => 'cdi',
                    'CDD' => 'cdd',
                    'Interim' => 'interim',
                ]
            ])


            ->add('date_sortie', DateType::class,[
                "attr" => [
                    "class" => "form-control"
                ]
            ])

        ;

//        ----- tentative n°1 de choix conditionnel CDI/date -----
//        if ('choices' == 'cdi'){
////                $builder->add('date_sortie', disabledType::class, [
//            $builder->add('date_sortie', HiddenType::class, [
//                'disabled' => 'disabled',
//            ]);
//        }

//        ----- tentative n°2 de choix conditionnel CDI/date -----
//        if('choices' =='cdi'){
//            $builder->remove('date_sortie');
//        }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection'=> true
        ]);
    }
}
