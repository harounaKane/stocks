<?php


namespace App\form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FormCategorie extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add("nom", TextType::class, [
                "attr" =>[
                    "placeholder" => "nom",
                    "minlength" => 2,
                    "maxlength" => 20
                ]
            ])
            ->add('description', TextareaType::class, [
                "required" => false
            ])
            ->add("Ajouter", SubmitType::class)
        ;
    }
}