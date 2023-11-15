<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="commande_id", columns={"commande_id"})})
 * @ORM\Entity
 */
class Livraison
{
    /**
     * @var int
     *
     * @ORM\Column(name="livraison_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $livraisonId;

    /**
     * @var int
     *
     * @ORM\Column(name="commande_id", type="integer", nullable=false)
     */
    private $commandeId;

    /**
     * @var int
     *
     * @ORM\Column(name="coursier_id", type="integer", nullable=false)
     */
    private $coursierId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_livraison", type="date", nullable=false)
     */
    private $dateLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_livraison", type="string", length=255, nullable=false)
     */
    private $statutLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_livraison", type="string", length=255, nullable=false)
     */
    private $adresseLivraison;


}
