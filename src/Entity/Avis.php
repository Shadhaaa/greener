<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity
 */
class Avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAvis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idavis;

    /**
     * @var string
     *
     * @ORM\Column(name="detailAvisService", type="string", length=255, nullable=false)
     */
    private $detailavisservice;

    /**
     * @var int
     *
     * @ORM\Column(name="noteService", type="integer", nullable=false)
     */
    private $noteservice;

    /**
     * @var int
     *
     * @ORM\Column(name="idArticle", type="integer", nullable=true)
     */
    private $idarticle;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="string", length=255, nullable=true)
     */
    private $service;

    public function getIdavis(): ?int
    {
        return $this->idavis;
    }

    public function getDetailavisservice(): ?string
    {
        return $this->detailavisservice;
    }

    public function setDetailavisservice(string $detailavisservice): self
    {
        $this->detailavisservice = $detailavisservice;

        return $this;
    }

    public function getNoteservice(): ?int
    {
        return $this->noteservice;
    }

    public function setNoteservice(int $noteservice): self
    {
        $this->noteservice = $noteservice;

        return $this;
    }

    public function getIdarticle(): ?int
    {
        return $this->idarticle;
    }

    public function setIdarticle(int $idarticle): self
    {
        $this->idarticle = $idarticle;

        return $this;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }
}
