<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EntrepriseRepository;
use App\Entity\Entreprise;


#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]

class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ? int $idEntreprise= null;


    #[ORM\Column(length:150)] 
    private ?string $nom= null;

    #[ORM\Column(length: 25)]
    private ? string $prenom= null;

    #[ORM\Column(length: 25)]
    private ? string $pdp= null;
    
    #[ORM\Column]
    private ? int $num= null;

    #[ORM\Column(length: 20)]
    private ? string $mail= null;

    #[ORM\Column(length: 30)]
    private ? string $mdp1= null;
   
    #[ORM\Column(length: 20)]
    private ? string $role= null;

    #[ORM\Column(length: 50)]
    private ? string $adresse= null;


    #[ORM\Column(length: 30)]
    private ? string $genre= null;

    
    #[ORM\Column(length: 200)]
    private ? string $logo= null;
    
    #[ORM\Column(length: 20)]
    private ? string $nomEntreprise= null;

    #[ORM\Column(length: 40)]
    private ? string $secteur= null;
    
    #[ORM\Column(length: 30)]
    private ? string $description= null;

    public function getIdEntreprise(): ?string
    {
        return $this->idEntreprise;
    }

    public function setIdEntreprise(string $idEntreprise): static
    {
        $this->idEntreprise = $idEntreprise;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPdp(): ?string
    {
        return $this->pdp;
    }

    public function setPdp(string $pdp): static
    {
        $this->pdp = $pdp;

        return $this;
    }

    public function getNum(): ?string
    {
        return $this->num;
    }

    public function setNum(string $num): static
    {
        $this->num = $num;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp1(): ?string
    {
        return $this->mdp1;
    }

    public function setMdp1(string $mdp1): static
    {
        $this->mdp1 = $mdp1;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): static
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(string $secteur): static
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }



}
