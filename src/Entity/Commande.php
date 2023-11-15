<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="FK_Commande_Panier", columns={"panierId"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="commande_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commandeId;

    /**
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     */
    private $clientId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_commande", type="date", nullable=true)
     */
    private $dateCommande;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantTotal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_livraison", type="string", length=255, nullable=true)
     */
    private $adresseLivraison;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_livraison", type="date", nullable=true)
     */
    private $dateLivraison;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mode_paiement", type="string", length=50, nullable=true)
     */
    private $modePaiement;

    /**
     * @var \Panier
     *
     * @ORM\ManyToOne(targetEntity="Panier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="panierId", referencedColumnName="panierId")
     * })
     */
    private $panierid;


}
