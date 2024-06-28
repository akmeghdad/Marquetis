<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: "App\Repository\VehiculeRepository")]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private string $marque;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private string $modele;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private \DateTime $dateImmatriculation;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private string $numeroImmatriculation;

    #[ORM\Column(type: 'json', nullable: true)]
    private array $caracteristiques = [];

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proprietaire', inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    private Proprietaire $proprietaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getDateImmatriculation(): ?\DateTimeInterface
    {
        return $this->dateImmatriculation;
    }

    public function setDateImmatriculation(\DateTimeInterface $dateImmatriculation): static
    {
        $this->dateImmatriculation = $dateImmatriculation;

        return $this;
    }

    public function getNumeroImmatriculation(): ?string
    {
        return $this->numeroImmatriculation;
    }

    public function setNumeroImmatriculation(string $numeroImmatriculation): static
    {
        $this->numeroImmatriculation = $numeroImmatriculation;

        return $this;
    }

    public function getCaracteristiques(): ?array
    {
        return $this->caracteristiques;
    }

    public function setCaracteristiques(?array $caracteristiques): static
    {
        $this->caracteristiques = $caracteristiques;

        return $this;
    }

    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Proprietaire $proprietaire): static
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

}
