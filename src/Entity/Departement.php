<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 */
class Departement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation;

    public function getId(): ?int

    {
        return $this->id;
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
     * @ORM\ManyToOne(targetEntity="Societe", inversedBy="products")
     */
    private $Societe;

    public function getSociete(): ?Societe
    {
        return $this->Societe;
    }

    public function setSociete(?Societe $Societe): self
    {
        $this->Societe = $Societe;

        return $this;
    }
    /**
     * @ORM\ManyToOne(targetEntity="Specialite", inversedBy="products")
     */
    private $Specialite;

    public function getSpecialite(): ?Specialite
    {
        return $this->Specialite;
    }

    public function setSpecialite(?Specialite $Specialite): self
    {
        $this->Specialite = $Specialite;

        return $this;
    }


    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     */
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function __toString()
    {
        return $this->nom;

    }
    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\User",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
    protected $chef;


    public function getUser(): ?User
    {
        return $this->chef;
    }

    public function setUser(?User $chef): self
    {
        $this->chef = $chef;

        return $this;
    }

}