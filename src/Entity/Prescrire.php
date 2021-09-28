<?php

namespace App\Entity;

use App\Repository\PrescrireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrescrireRepository::class)
 */
class Prescrire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Medicament::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $MED_DepotLegal;

    /**
     * @ORM\ManyToOne(targetEntity=TypeIndividu::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $TIN_Code;

    /**
     * @ORM\ManyToOne(targetEntity=Dosage::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $DOS_Code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PRE_Posologie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMEDDepotLegal(): ?Medicament
    {
        return $this->MED_DepotLegal;
    }

    public function setMEDDepotLegal(?Medicament $MED_DepotLegal): self
    {
        $this->MED_DepotLegal = $MED_DepotLegal;

        return $this;
    }

    public function getTINCode(): ?TypeIndividu
    {
        return $this->TIN_Code;
    }

    public function setTINCode(?TypeIndividu $TIN_Code): self
    {
        $this->TIN_Code = $TIN_Code;

        return $this;
    }

    public function getDOSCode(): ?Dosage
    {
        return $this->DOS_Code;
    }

    public function setDOSCode(?Dosage $DOS_Code): self
    {
        $this->DOS_Code = $DOS_Code;

        return $this;
    }

    public function getPREPosologie(): ?string
    {
        return $this->PRE_Posologie;
    }

    public function setPREPosologie(?string $PRE_Posologie): self
    {
        $this->PRE_Posologie = $PRE_Posologie;

        return $this;
    }
}
