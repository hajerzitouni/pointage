<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

/**
 * @ORM\Entity(repositoryClass=HistoriqueRepository::class)
 */
class Historique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heure_arrive;

    public function getheurearrive(): ?string
    {
        return $this->heure_arrive;
    }

    public function setheurearrive(string $heure_arrive): self
    {
        $this->heure_arrive = $heure_arrive;

        return $this;
    }


    /**
     *  * @ORM\Column(type="string", length=255)
     */
    private $heure_depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ecart;

    /**
     * @ORM\Column(type="boolean")
     */
    private $conge;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getheuredepart(): ?string
    {
        return $this->heure_depart;
    }

    public function setheuredepart(string $heure_depart): self
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }




    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEcart(): ?string
    {
        return $this->ecart;
    }

    public function setEcart(string $ecart): self
    {
        $this->ecart = $ecart;

        return $this;
    }

    public function getConge(): ?bool
    {
        return $this->conge;
    }

    public function setConge(bool $conge): self
    {
        $this->conge = $conge;

        return $this;
    }

    public function getCreation(): ?\DateTimeInterface
    {
        return $this->creation;
    }

    public function setCreation(\DateTimeInterface $creation): self
    {
        $this->creation = $creation;

        return $this;
    }
    /**
     * @ORM\ManyToOne(targetEntity="Employe", inversedBy="historiques")
     */

    private $Employe;

    public function getEmploye()
    {
        return $this->Employe;
    }

    public function setEmploye($Employe)
    {
        $this->Employe = $Employe;


    }

    public function __construct()
    {
        $this->creation= new \Datetime();

    }
}
