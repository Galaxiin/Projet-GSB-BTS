<?php

namespace App\Entity;

use App\Repository\ComposantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComposantRepository::class)
 */
class Composant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $CMP_Code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CMP_Libelle;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="composants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CMP_Auteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCMPCode(): ?int
    {
        return $this->CMP_Code;
    }

    public function setCMPCode(int $CMP_Code): self
    {
        $this->CMP_Code = $CMP_Code;

        return $this;
    }

    public function getCMPLibelle(): ?string
    {
        return $this->CMP_Libelle;
    }

    public function setCMPLibelle(string $CMP_Libelle): self
    {
        $this->CMP_Libelle = $CMP_Libelle;

        return $this;
    }

    public function getCMPAuteur(): ?User
    {
        return $this->CMP_Auteur;
    }

    public function setCMPAuteur(?User $CMP_Auteur): self
    {
        $this->CMP_Auteur = $CMP_Auteur;

        return $this;
    }
}
