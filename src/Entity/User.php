<?php

namespace App\Entity;

use App\Entity\Role;
use App\Entity\Medicament;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Medicament::class, mappedBy="auteur")
     */
    private $medicaments;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, mappedBy="users")
     */
    private $RolesUser;

    public function getFullName() {        
        return "{$this->Nom} {$this->Prenom}";
    }

    public function getTitreFullName() {
        foreach ($this->RolesUser as $role) {
            if ($role->getTitre() == "ROLE_ADMIN") {
                return "IT. {$this->Nom} {$this->Prenom}";
            }
            elseif ($role->getTitre() == "ROLE_PRACTICIEN") {
                return "DR. {$this->Nom} {$this->Prenom}";
            }
        }
    }

    public function __construct()
    {
        $this->medicaments = new ArrayCollection();
        $this->RolesUser = new ArrayCollection();
        $this->composants = new ArrayCollection();
        $this->familles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    //Fonctions obligatioires pour le User Interface
    
    public function getRoles()
    {
        $roles = $this->RolesUser->map(function($role){
            return $role->getTitre();
        })->ToArray();

        $roles[] = 'ROLE_PRACTICIEN';

        return $roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->RolesUser;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->RolesUser->contains($userRole)) {
            $this->RolesUser[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->RolesUser->contains($userRole)) {
            $this->RolesUser->removeElement($userRole);
            $userRole->removeUser($this);
        }

        return $this;
    }

    // FIN UserInterface

    /**
     * @return \Doctrine\Common\Collections\Collection|Medicament[]
     */
    public function getMedicaments(): \Doctrine\Common\Collections\Collection
    {
        return $this->medicaments;
    }

    public function addMedicament(Medicament $medicament): self
    {
        if (!$this->medicaments->contains($medicament)) {
            $this->medicaments[] = $medicament;
            $medicament->setMED_Auteur($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->medicaments->removeElement($medicament)) {
            // set the owning side to null (unless already changed)
            if ($medicament->getMED_Auteur() === $this) {
                $medicament->getMED_Auteur(null);
            }
        }

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Role[]
     */
    public function getRolesUser(): \Doctrine\Common\Collections\Collection
    {
        return $this->RolesUser;
    }

    public function addRolesUser(Role $rolesUser): self
    {
        if (!$this->RolesUser->contains($rolesUser)) {
            $this->RolesUser[] = $rolesUser;
        }

        return $this;
    }

    public function removeRolesUser(Role $rolesUser): self
    {
        $this->RolesUser->removeElement($rolesUser);

        return $this;
    }

    /**
     * @return Collection|Composant[]
     */
    public function getComposants(): Collection
    {
        return $this->composants;
    }

    public function addComposant(Composant $composant): self
    {
        if (!$this->composants->contains($composant)) {
            $this->composants[] = $composant;
            $composant->setCMPAuteur($this);
        }

        return $this;
    }

    public function removeComposant(Composant $composant): self
    {
        if ($this->composants->removeElement($composant)) {
            // set the owning side to null (unless already changed)
            if ($composant->getCMPAuteur() === $this) {
                $composant->setCMPAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Famille[]
     */
    public function getFamilles(): Collection
    {
        return $this->familles;
    }

    public function addFamille(Famille $famille): self
    {
        if (!$this->familles->contains($famille)) {
            $this->familles[] = $famille;
            $famille->setFAMAuteur($this);
        }

        return $this;
    }

    public function removeFamille(Famille $famille): self
    {
        if ($this->familles->removeElement($famille)) {
            // set the owning side to null (unless already changed)
            if ($famille->getFAMAuteur() === $this) {
                $famille->setFAMAuteur(null);
            }
        }

        return $this;
    }
}
