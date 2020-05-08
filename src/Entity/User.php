<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mdp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"},
     *     maxSize = "2400k",
     *     mimeTypesMessage = "Format pas autorisé here"
     * )
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }
}
