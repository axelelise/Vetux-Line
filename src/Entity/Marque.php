<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity=Vehicule::class, mappedBy="Marque", orphanRemoval=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    public function __construct()
    {
        $this->id = new ArrayCollection();
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

    /**
     * @return Collection|Vehicule[]
     */
    public function getid(): Collection
    {
        return $this->id;
    }

    public function addid(Vehicule $id): self
    {
        if (!$this->id->contains($id)) {
            $this->blabla[] = $id;
            $id->setMarque($this);
        }

        return $this;
    }

    public function removeBlabla(Vehicule $id): self
    {
        if ($this->id->removeElement($id)) {
            // set the owning side to null (unless already changed)
            if ($id->getMarque() === $this) {
                $id->setMarque(null);
            }
        }

        return $this;
    }
}
