<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentairesRepository;

#[ORM\Entity(repositoryClass: CommentairesRepository::class)]
class Commentaires
{
    #[ORM\Id] 
    #[ORM\GeneratedValue] 
    #[ORM\Column(type: "integer")] 
    private ?int $idCommentaire = null;

     
     
    #[ORM\Column(type: "integer")]
    private ?int $idUser = null;

    
     
    #[ORM\Column(type: "integer")] 
    private ?int $idPost = null;

    #[ORM\Column(length: 200)]
    private ?string $contenu = null;

    #[ORM\Column(length: 20)]
    private ?string $statut = null;

    public function getIdCommentaire(): ?int
    {
        return $this->idCommentaire;
    }

    public function setIdCommentaire(string $idCommentaire): static
    {
        $this->idCommentaire = $idCommentaire;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(string $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdPost(): ?int
    {
        return $this->idPost;
    }

    public function setIdPost(string $idPost): static
    {
        $this->idPost = $idPost;

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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }


}
