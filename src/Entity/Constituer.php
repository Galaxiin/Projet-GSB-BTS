<?php

namespace App\Entity;

use App\Repository\ConstituerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConstituerRepository::class)
 */
class Constituer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Medicament::class, inversedBy="Composants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MED_DepotLegal;

    /**
     * @ORM\ManyToOne(targetEntity=Composant::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $CMP_Code;

    /**
     * @ORM\Column(type="float")
     */
    private $CST_QTE;

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

    public function getCMPCode(): ?Composant
    {
        return $this->CMP_Code;
    }

    public function setCMPCode(?Composant $CMP_Code): self
    {
        $this->CMP_Code = $CMP_Code;

        return $this;
    }

    public function getCSTQTE(): ?int
    {
        return $this->CST_QTE;
    }

    public function setCSTQTE(int $CST_QTE): self
    {
        $this->CST_QTE = $CST_QTE;

        return $this;
    }
}
