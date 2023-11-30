<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Reclamation implements JsonSerializable
{

    /**
     * @var int
     *
     * @ORM\Column(name="idReclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="screenshot", type="string", length=255, nullable=true)
     */
    private $screenshot;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_mobile", type="string", length=255, nullable=false)
     */
    private $numeroMobile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_traitement", type="date", nullable=true)
     */
    private $dateTraitement;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="nomServcie", type="string", length=255, nullable=false)
     */
    private $nomservcie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="products", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(name="priority", type="integer", nullable=true)
     * @var int
     */
    private $priority;

    public function getIdreclamation(): ?int
    {
        return $this->idreclamation;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getScreenshot(): ?string
    {
        return $this->screenshot;
    }

    public function setScreenshot(string $screenshot): self
    {
        $this->screenshot = $screenshot;

        return $this;
    }

    public function getNumeroMobile(): ?string
    {
        return $this->numeroMobile;
    }

    public function setNumeroMobile(string $numeroMobile): self
    {
        $this->numeroMobile = $numeroMobile;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateTraitement(): ?\DateTimeInterface
    {
        return $this->dateTraitement;
    }

    public function setDateTraitement(?\DateTimeInterface $dateTraitement): self
    {
        $this->dateTraitement = $dateTraitement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNomservcie(): ?string
    {
        return $this->nomservcie;
    }

    public function setNomservcie(string $nomservcie): self
    {
        $this->nomservcie = $nomservcie;

        return $this;
    }
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->dateCreation = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
    
    /**
     * Specify data which should be serialized to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize()
    {
        return array(
            'idreclamation' => $this->idreclamation,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'screenshot' => $this->screenshot,
            'numeroMobile' => $this->numeroMobile,
            'dateCreation' => $this->dateCreation,
            'dateTraitement' => $this->dateTraitement,
            'description' => $this->description,
            'status' => $this->status,
            'nomservcie' => $this->nomservcie,
            'image' => $this->image,
            'priority' => $this->priority,
        );
    }
}
