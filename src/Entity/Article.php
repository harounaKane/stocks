<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     * @Assert\Length(
     *     min = 2,
     *     max = 20,
     *     minMessage = "tapez au minimum {{ limit }} caractères",
     *     maxMessage = "tapez au maximum {{ limit }} caractères"
     * )
     */
    private $designation;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(
     *     min = 0.5,
     *     max = 1999,
     *     minMessage = "Prix minimum est de {{ limit }} € ",
     *     maxMessage = "Prix maximum est de {{ limit }} € "
     * )
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="article")
     * @ORM\JoinColumn()
     */
    private $categorie;

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie( $categorie ): void
    {
        $this->categorie = $categorie;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }
}
