<?php


namespace App\form;


use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FormArticle extends AbstractType
{

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add("designation", TextType::class, [
                'attr' => [
                    "placeholder" => "Désignation",
                    "minlength" => 2,
                    "maxlength" => 15
                ]
            ])
            ->add("prix", NumberType::class, [
                "attr" => [
                    "min" => 0.5,
                    "max" => 1999
                ]
            ])
            ->add("marque", TextType::class, [
                'attr' => [
                    "placeholder" => "Marque",
                    "minlength" => 3,
                    "maxlength" => 15
                ]
            ])
            ->add("categorie", EntityType::class, [
                "class" => Categorie::class,
                "choice_label" => function($categorie){
                    return $categorie->getNom();
                }
            ])
            ->add("Ajouter", SubmitType::class)
        ;
    }
}