<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Repository\PostRepository;
use Symfony\Component\Validator\Constraints as Assert;




#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $idPost = null;

 
    
    #[ORM\Column(type: "integer")]
    private ?int $idEntreprise = null;

    
    #[ORM\Column(length: 50)] 
    #[Assert\NotBlank(message: 'you should enter a title')]
    private ?string $titre = null;

    
    #[ORM\Column(length: 100)] 
    private ?string $typedecontenu = null;

    
    #[ORM\Column(length: 500)]
    private ?string $contenu = null;

    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    
    private ?\DateTimeInterface $date = null;
    

    #[ORM\Column(length: 200)]
    #[Assert\Url(message:'enter a valid url')]
    private ? string $image = null;

    public function getIdPost(): ?int
    {
        return $this->idPost;
    }

    public function setIdPost(string $idPost): static
    {
        $this->idPost = $idPost;

        return $this;
    }

    public function getIdEntreprise(): ?int
    {
        return $this->idEntreprise;
    }

    public function setIdEntreprise(string $idEntreprise): static
    {
        $this->idEntreprise = $idEntreprise;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTypedecontenu(): ?string
    {
        return $this->typedecontenu;
    }

    public function setTypedecontenu(string $typedecontenu): static
    {
        $this->typedecontenu = $typedecontenu;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }


}
