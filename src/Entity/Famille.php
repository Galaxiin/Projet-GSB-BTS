<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert; // contraintes de champs
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FamilleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=FamilleRepository::class)
 */
class Famille
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(min=8, max=8, minMessage="le code doit avoir 8 chiffres !")
     */
    private $FAM_Code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FAM_Libelle;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="familles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $FAM_Auteur;

    /**
     * @ORM\OneToMany(targetEntity=Medicament::class, mappedBy="MED_Famille")
     */
    private $FAM_medicaments;

    public function __construct()
    {
        $this->FAM_medicaments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFAMCode(): ?int
    {
        return $this->FAM_Code;
    }

    public function setFAMCode(int $FAM_Code): self
    {
        $this->FAM_Code = $FAM_Code;

        return $this;
    }

    public function getFAMLibelle(): ?string
    {
        return $this->FAM_Libelle;
    }

    public function setFAMLibelle(string $FAM_Libelle): self
    {
        $this->FAM_Libelle = $FAM_Libelle;

        return $this;
    }

    public function getFAMAuteur(): ?User
    {
        return $this->FAM_Auteur;
    }

    public function setFAMAuteur(?User $FAM_Auteur): self
    {
        $this->FAM_Auteur = $FAM_Auteur;

        return $this;
    }

    /**
     * @return Collection|Medicament[]
     */
    public function getFAMmedicaments(): Collection
    {
        return $this->FAM_medicaments;
    }

    public function addMedicament(Medicament $medicament): self
    {
        if (!$this->FAM_medicaments->contains($medicament)) {
            $this->FAM_medicaments[] = $medicament;
            $medicament->setMEDFamille($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->FAM_medicaments->removeElement($medicament)) {
            // set the owning side to null (unless already changed)
            if ($medicament->getMEDFamille() === $this) {
                $medicament->setMEDFamille(null);
            }
        }

        return $this;
    }
}
