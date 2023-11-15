<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenment
 *
 * @ORM\Table(name="evenment")
 * @ORM\Entity
 */
class Evenment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_evenment", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvenment;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100, nullable=false)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=100, nullable=false)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="description_evenment", type="string", length=100, nullable=false)
     */
    private $descriptionEvenment;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=100, nullable=false)
     */
    private $photo;

    /**
     * @var int
     *
     * @ORM\Column(name="id_participant", type="integer", nullable=false)
     */
    private $idParticipant;

    /**
     * @var int
     *
     * @ORM\Column(name="id_entreprise", type="integer", nullable=false)
     */
    private $idEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="QRcode", type="string", length=100, nullable=false)
     */
    private $qrcode;

    /**
     * @var string
     *
     * @ORM\Column(name="liste_participant", type="string", length=100, nullable=false)
     */
    private $listeParticipant;


}
