<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le prénom et le nom sont requis.']),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Le prénom et le nom doivent comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le prénom et le nom ne peuvent pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('firstname', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le prénom et le nom sont requis.']),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Le prénom et le nom doivent comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le prénom et le nom ne peuvent pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('lastname', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le prénom et le nom sont requis.']),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Le prénom et le nom doivent comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le prénom et le nom ne peuvent pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            
             ->add('email', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'L\'email est requis.']),
                    new Assert\Email(['message' => 'L\'email n\'est pas valide.']),
                ],
            ])
             ->add('password', PasswordType::class)
             ->add('passwordConfirm', PasswordType::class)
            
            ->add('send', SubmitType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
