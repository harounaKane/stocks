<?php

namespace App\form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, [
                'attr' => [
                    "placeholder" => "Prénom"
                ]
            ])
            ->add('login', TextType::class, [
                'attr' => [
                    "placeholder" => "Login"
                ]
            ])
            ->add('mdp', RepeatedType::class, [
                "type" => PasswordType::class,
                "first_options" => ["label" => "Mot de passe"],
                "second_options" => ["label" => "Confirmation"]
            ])
            ->add("pays", CountryType::class)
            ->add("photo", FileType::class, [
                "required" => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
