<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrefRepository")
 * @UniqueEntity(fields="name", message="il existe déjà une activitée de ce nom")
 */
class Activites
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     * Validation :
     *  -non vide
     * @Assert\NotBlank(message="Le nom est obligatoire")
     *  - nombre de caractères
     * @Assert\Length(max="20", maxMessage="Le nom ne doit pas dépasser {{ limit }} caractères")
     */
    private $name;

    /**
     * @param ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="activites")
     */
    private $user_activites;

    public function __construct () {
        $this->user_activites = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserActivites()
    {
        return $this->user_activites;
    }

    /**
     * @param mixed $user_activites
     * @return Activites
     */
    public function setUserActivites($user_activites)
    {
        $this->user_activites = $user_activites;
        return $this;
    }

    public function addUserActivite($user_activites)
    {
        $this->user_activites->add($user_activites);
    }

    public function __toString()
    {
        return $this->name;
    }

}