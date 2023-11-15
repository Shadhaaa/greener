<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_evenement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvenement;

    /**
     * @var int
     *
     * @ORM\Column(name="id_entreprise", type="integer", nullable=false)
     */
    private $idEntreprise;

    /**
     * @var int
     *
     * @ORM\Column(name="id_participant", type="integer", nullable=false)
     */
    private $idParticipant;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_evenement", type="string", length=500, nullable=false)
     */
    private $titreEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="date_evenement", type="string", length=100, nullable=false)
     */
    private $dateEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="QRcode", type="string", length=500, nullable=false)
     */
    private $qrcode;

    /**
     * @var string
     *
     * @ORM\Column(name="image_evenement", type="string", length=500, nullable=false)
     */
    private $imageEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_evenement", type="string", length=500, nullable=false)
     */
    private $lieuEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="description_evenement", type="string", length=500, nullable=false)
     */
    private $descriptionEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="liste_participants", type="string", length=500, nullable=false)
     */
    private $listeParticipants;


}
