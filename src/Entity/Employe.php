<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
/**
 * @ORM\Entity(repositoryClass=EmployeRepository::class)
 */
class Employe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @var User
     *
     * @Assert\Valid()
     * @Assert\Type(type="App\Entity\User")
     *
     * @ORM\OneToOne(targetEntity="App\Entity\User",cascade={"persist"})
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return User
     */
    public function setUser(\App\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Departement", inversedBy="employes")
     */
    private $Departement;

    public function getDepartement(): ?Departement
    {
        return $this->Departement;
    }

    public function setDepartement(?Departement $Departement): self
    {
        $this->Departement = $Departement;

        return $this;
    }
    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="creation", type="datetime", nullable=true)
     */
    private $creation;

    /**
     * @return \DateTime|null
     */
    public function getCreation(): ?\DateTime
    {
        return $this->creation;
    }

    /**
     * @param \DateTime|null $creation
     */
    public function setCreation(?\DateTime $creation): void
    {
        $this->creation = $creation;
    }

    public function __construct()
    {
        $this->creation= new \Datetime();

    }

    public function __toString()
    {
        return $this->user->getUsername();

    }

    public function getemail()
    {
        return $this->user->getEmail();

    }

}
