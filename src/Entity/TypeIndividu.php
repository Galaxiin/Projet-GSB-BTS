<?php

namespace App\Entity;

use App\Repository\TypeIndividuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeIndividuRepository::class)
 */
class TypeIndividu
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
    private $TIN_Code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TIN_Libelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTINCode(): ?int
    {
        return $this->TIN_Code;
    }

    public function setTINCode(int $TIN_Code): self
    {
        $this->TIN_Code = $TIN_Code;

        return $this;
    }

    public function getTINLibelle(): ?string
    {
        return $this->TIN_Libelle;
    }

    public function setTINLibelle(string $TIN_Libelle): self
    {
        $this->TIN_Libelle = $TIN_Libelle;

        return $this;
    }
}
