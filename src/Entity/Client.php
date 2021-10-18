<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

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
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NumTel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CCType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CCNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CVV2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CCExpires;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdressePhysique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $City;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $State;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CodePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Taille;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Poids;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Véhicule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Latitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Longitude;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
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
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getDateDeNaissance(): ?string
    {
        return $this->DateDeNaissance;
    }

    public function setDateDeNaissance(string $DateDeNaissance): self
    {
        $this->DateDeNaissance = $DateDeNaissance;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->NumTel;
    }

    public function setNumTel(string $NumTel): self
    {
        $this->NumTel = $NumTel;

        return $this;
    }

    public function getCCType(): ?string
    {
        return $this->CCType;
    }

    public function setCCType(string $CCType): self
    {
        $this->CCType = $CCType;

        return $this;
    }

    public function getCCNumber(): ?string
    {
        return $this->CCNumber;
    }

    public function setCCNumber(string $CCNumber): self
    {
        $this->CCNumber = $CCNumber;

        return $this;
    }

    public function getCVV2(): ?string
    {
        return $this->CVV2;
    }

    public function setCVV2(string $CVV2): self
    {
        $this->CVV2 = $CVV2;

        return $this;
    }

    public function getCCExpires(): ?string
    {
        return $this->CCExpires;
    }

    public function setCCExpires(string $CCExpires): self
    {
        $this->CCExpires = $CCExpires;

        return $this;
    }

    public function getAdressePhysique(): ?string
    {
        return $this->AdressePhysique;
    }

    public function setAdressePhysique(string $AdressePhysique): self
    {
        $this->AdressePhysique = $AdressePhysique;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->State;
    }

    public function setState(string $State): self
    {
        $this->State = $State;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->CodePostal;
    }

    public function setCodePostal(string $CodePostal): self
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->Taille;
    }

    public function setTaille(string $Taille): self
    {
        $this->Taille = $Taille;

        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->Poids;
    }

    public function setPoids(string $Poids): self
    {
        $this->Poids = $Poids;

        return $this;
    }

    public function getVéhicule(): ?string
    {
        return $this->Véhicule;
    }

    public function setVéhicule(string $Véhicule): self
    {
        $this->Véhicule = $Véhicule;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->Latitude;
    }

    public function setLatitude(string $Latitude): self
    {
        $this->Latitude = $Latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->Longitude;
    }

    public function setLongitude(string $Longitude): self
    {
        $this->Longitude = $Longitude;

        return $this;
    }
}
