<?php

namespace App\Entity\Clients;

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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prénom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroTel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CCType;

    /**
     * @ORM\Column(type="integer")
     */
    private $CCNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $CVV2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CCExpires;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressePhysique;

    /**
     * @ORM\Column(type="integer")
     */
    private $taille;

    /**
     * @ORM\Column(type="float")
     */
    private $poids;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vehicule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coordonnéesGPS;

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
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrénom(): ?string
    {
        return $this->prénom;
    }

    public function setPrénom(string $prénom): self
    {
        $this->prénom = $prénom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getNumeroTel(): ?string
    {
        return $this->numeroTel;
    }

    public function setNumeroTel(string $numeroTel): self
    {
        $this->numeroTel = $numeroTel;

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

    public function getCCNumber(): ?int
    {
        return $this->CCNumber;
    }

    public function setCCNumber(int $CCNumber): self
    {
        $this->CCNumber = $CCNumber;

        return $this;
    }

    public function getCVV2(): ?int
    {
        return $this->CVV2;
    }

    public function setCVV2(int $CVV2): self
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
        return $this->adressePhysique;
    }

    public function setAdressePhysique(string $adressePhysique): self
    {
        $this->adressePhysique = $adressePhysique;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getVehicule(): ?string
    {
        return $this->vehicule;
    }

    public function setVehicule(string $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getCoordonnéesGPS(): ?string
    {
        return $this->coordonnéesGPS;
    }

    public function setCoordonnéesGPS(string $coordonnéesGPS): self
    {
        $this->coordonnéesGPS = $coordonnéesGPS;

        return $this;
    }
}