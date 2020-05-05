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
                    "minlength" => 5
                ]
            ])
            ->add('description', TextareaType::class)
            ->add("Ajouter", SubmitType::class)
        ;
    }
}