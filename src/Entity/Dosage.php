<?php

namespace App\Entity;

use App\Repository\DosageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DosageRepository::class)
 */
class Dosage
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
    private $DOS_Code;

    /**
     * @ORM\Column(type="integer")
     */
    private $DOS_Quantite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DOS_Unite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDOSCode(): ?int
    {
        return $this->DOS_Code;
    }

    public function setDOSCode(int $DOS_Code): self
    {
        $this->DOS_Code = $DOS_Code;

        return $this;
    }

    public function getDOSQuantite(): ?int
    {
        return $this->DOS_Quantite;
    }

    public function setDOSQuantite(int $DOS_Quantite): self
    {
        $this->DOS_Quantite = $DOS_Quantite;

        return $this;
    }

    public function getDOSUnite(): ?string
    {
        return $this->DOS_Unite;
    }

    public function setDOSUnite(string $DOS_Unite): self
    {
        $this->DOS_Unite = $DOS_Unite;

        return $this;
    }
}
