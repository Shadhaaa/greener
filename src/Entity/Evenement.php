<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Repository\EvenementRepository;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idEvenement = null;

    #[ORM\Column]
    private ?int $idEntreprise = null;
    
    #[ORM\Column]
    private ?int $idParticipant = null;
    
    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: "vous devez mettre votre titre !!!")]
    private ?string $titreEvenement = null;
   
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "vous devez entrer la date !!!")]
    #[Assert\Date\DateTime(message: "vous devez entrer la date !!!")]
    private ?\DateTime $dateEvenement = null;
    
    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: "vous devez mettre votre qrcode !!!")]
    private ?string $qrcode = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: "vous devez mettre votre lieu!!!")]
    #[Assert\Url(message: "vous devez entrer une adresse URL valid !!!")]
    private ?string $imageEvenement = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: "vous devez mettre votre lieu!!!")]
    private ?string $lieuEvenement= null;
    
    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: "vous devez mettre votre description!!!")]
    private ?string $descriptionEvenement= null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: "vous devez mettre votre liste!!!")]
    private ?string $liste_participants= null;

    public function getIdEvenement(): ?int
    {
        return $this->idEvenement;
    }

    public function getIdEntreprise(): ?int
    {
        return $this->idEntreprise;
    }

    public function setIdEntreprise(int $idEntreprise): static
    {
        $this->idEntreprise = $idEntreprise;

        return $this;
    }

    public function getIdParticipant(): ?int
    {
        return $this->idParticipant;
    }

    public function setIdParticipant(int $idParticipant): static
    {
        $this->idParticipant = $idParticipant;

        return $this;
    }

    public function getTitreEvenement(): ?string
    {
        return $this->titreEvenement;
    }

    public function setTitreEvenement(string $titreEvenement): static
    {
        $this->titreEvenement = $titreEvenement;

        return $this;
    }

    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement(\DateTimeInterface $dateEvenement): static
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    public function getQrcode(): ?string
    {
        return $this->qrcode;
    }

    public function setQrcode(string $qrcode): static
    {
        $this->qrcode = $qrcode;

        return $this;
    }

    public function getImageEvenement(): ?string
    {
        return $this->imageEvenement;
    }

    public function setImageEvenement(string $imageEvenement): static
    {
        $this->imageEvenement = $imageEvenement;

        return $this;
    }

    public function getLieuEvenement(): ?string
    {
        return $this->lieuEvenement;
    }

    public function setLieuEvenement(string $lieuEvenement): static
    {
        $this->lieuEvenement = $lieuEvenement;

        return $this;
    }

    public function getDescriptionEvenement(): ?string
    {
        return $this->descriptionEvenement;
    }

    public function setDescriptionEvenement(string $descriptionEvenement): static
    {
        $this->descriptionEvenement = $descriptionEvenement;

        return $this;
    }

    public function getListeParticipants(): ?string
    {
        return $this->liste_participants;
    }

    public function setListeParticipants(string $liste_participants): static
    {
        $this->liste_participants = $liste_participants;

        return $this;
    }


}
