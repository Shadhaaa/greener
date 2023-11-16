<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelletProduit = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?int $productionMentuelle = null;

    #[ORM\Column(nullable: true)]
    private ?int $stockActuelle = null;

    #[ORM\Column(nullable: true)]
    private ?float $pollutionParPiece = null;

    #[ORM\ManyToOne]
    private ?Categorie $categorie = null;

    #[ORM\ManyToMany(targetEntity: Vehicule::class)]
    private Collection $vehicules;

    #[ORM\ManyToMany(targetEntity: Energie::class)]
    private Collection $energies;

    #[ORM\ManyToOne]
    private ?Entreprise $entreprise = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $consommationEnergie = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $distanceVehicule = null;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
        $this->energies = new ArrayCollection();
    }
    public function getIdProduit(): ?int
    {
        return $this->id;
    }

    public function getLibelletProduit(): ?string
    {
        return $this->libelletProduit;
    }

    public function setLibelletProduit(?string $libelletProduit): static
    {
        $this->libelletProduit = $libelletProduit;

        return $this;
    }
    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getProductionMentuelle(): ?int
    {
        return $this->productionMentuelle;
    }

    public function setProductionMentuelle(?int $productionMentuelle): static
    {
        $this->productionMentuelle = $productionMentuelle;

        return $this;
    }

    public function getStockActuelle(): ?int
    {
        return $this->stockActuelle;
    }

    public function setStockActuelle(?int $stockActuelle): static
    {
        $this->stockActuelle = $stockActuelle;

        return $this;
    }

    public function getPollutionParPiece(): ?float
    {
        return $this->pollutionParPiece;
    }

    public function setPollutionParPiece(?float $pollutionParPiece): static
    {
        $this->pollutionParPiece = $pollutionParPiece;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): static
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): static
    {
        $this->vehicules->removeElement($vehicule);

        return $this;
    }

    /**
     * @return Collection<int, Energie>
     */
    public function getEnergies(): Collection
    {
        return $this->energies;
    }

    public function addEnergy(Energie $energy): static
    {
        if (!$this->energies->contains($energy)) {
            $this->energies->add($energy);
        }

        return $this;
    }

    public function removeEnergy(Energie $energy): static
    {
        $this->energies->removeElement($energy);

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getConsommationEnergie(): ?array
    {
        return $this->consommationEnergie;
    }

    public function setConsommationEnergie(?array $consommationEnergie): static
    {
        $this->consommationEnergie = $consommationEnergie;

        return $this;
    }

    public function getDistanceVehicule(): ?array
    {
        return $this->distanceVehicule;
    }

    public function setDistanceVehicule(?array $distanceVehicule): static
    {
        $this->distanceVehicule = $distanceVehicule;

        return $this;
    }

}
