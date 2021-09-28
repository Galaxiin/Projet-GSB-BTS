<?php

namespace App\Entity;

use App\Repository\PresentationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresentationRepository::class)
 */
class Presentation
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
    private $PRE_Code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PRE_Libelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPRECode(): ?int
    {
        return $this->PRE_Code;
    }

    public function setPRECode(int $PRE_Code): self
    {
        $this->PRE_Code = $PRE_Code;

        return $this;
    }

    public function getPRELibelle(): ?string
    {
        return $this->PRE_Libelle;
    }

    public function setPRELibelle(string $PRE_Libelle): self
    {
        $this->PRE_Libelle = $PRE_Libelle;

        return $this;
    }
}
