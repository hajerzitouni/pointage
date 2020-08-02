<?php

namespace App\Entity;

use App\Repository\SpecialiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialiteRepository::class)
 */
class Specialite
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
    private $nomspecialite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomspecialite(): ?string
    {
        return $this->nomspecialite;
    }

    public function setNomspecialite(string $nomspecialite): self
    {
        $this->nomspecialite = $nomspecialite;

        return $this;
    }
    public function __toString()
    {
        return $this->nomspecialite;

    }

}
