<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="id_vehicule", orphanRemoval=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    //public function getId(): ?int
    //{
    //    return $this->id;
    //}

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection|Id[]
     */
    public function getId(): Collection
    {
        return $this->id;
    }

    public function addId(Client $id): self
    {
        if (!$this->id->contains($id)) {
            $this->id[] = $id;
            $id->setIdVehicule($this);
        }

        return $this;
    }

    public function removeClient(Client $id): self
    {
        if ($this->id->removeElement($id)) {
            // set the owning side to null (unless already changed)
            if ($id->getIdVehicule() === $this) {
                $id->setIdVehicule(null);
            }
        }

        return $this;
    }
}
