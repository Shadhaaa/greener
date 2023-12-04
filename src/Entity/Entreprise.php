<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide")]
    #[Assert\Length(max: 150, maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères")]
    private ?string $nom = null;

    #[ORM\Column(length: 25)]
    #[Assert\NotBlank(message: "Le prénom ne peut pas être vide")]
    #[Assert\Length(max: 25, maxMessage: "Le prénom ne peut pas dépasser {{ limit }} caractères")]
    private ?string $prenom = null;

    #[ORM\Column(length: 25)]
    private ?string $pdp;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le numéro ne peut pas être vide")]
    #[Assert\Type(type: "integer", message: "Le numéro doit être un entier")]
    private ?int $num;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: "L'adresse e-mail ne peut pas être vide")]
    #[Assert\Email(message: "L'adresse e-mail n'est pas valide")]
    private ?string $mail;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank(message: "Le mot de passe ne peut pas être vide")]
    #[Assert\Length(min: 6, minMessage: "Le mot de passe doit contenir au moins {{ limit }} caractères")]
    private ?string $mdp1;

    #[ORM\Column(length: 20)]
    private ?string $role;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "L'adresse ne peut pas être vide")]
    #[Assert\Length(max: 50, maxMessage: "L'adresse ne peut pas dépasser {{ limit }} caractères")]
    private ?string $adresse;

    #[ORM\Column(length: 30)]
    private ?string $genre;

    #[ORM\Column(length: 200)]
    private ?string $logo;

    #[ORM\Column(length: 200)]
    #[Assert\NotBlank(message: "Le nom de l'entreprise ne peut pas être vide")]
    #[Assert\Length(max: 200, maxMessage: "Le nom de l'entreprise ne peut pas dépasser {{ limit }} caractères")]
    private ?string $nomEntreprise;

    #[ORM\Column(length: 40)]
    #[Assert\NotBlank(message: "Le secteur ne peut pas être vide")]
    #[Assert\Length(max: 40, maxMessage: "Le secteur ne peut pas dépasser {{ limit }} caractères")]
    private ?string $secteur;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank(message: "La description ne peut pas être vide")]
    #[Assert\Length(max: 30, maxMessage: "La description ne peut pas dépasser {{ limit }} caractères")]
    private ?string $description;


    #[ORM\OneToMany(mappedBy: 'produits', targetEntity: Produit::class)]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getIdEntreprise(): ?int
    {
        return $this->id;
    }
}
