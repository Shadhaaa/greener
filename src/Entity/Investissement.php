<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Investissement
 *
 * @ORM\Table(name="investissement")
 * @ORM\Entity
 */
class Investissement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_investissement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInvestissement;

    /**
     * @var int
     *
     * @ORM\Column(name="id_investisseur", type="integer", nullable=false)
     */
    private $idInvestisseur;

    /**
     * @var int
     *
     * @ORM\Column(name="id_entreprise", type="integer", nullable=false)
     */
    private $idEntreprise;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_investissement", type="date", nullable=false)
     */
    private $dateDebutInvestissement;

    /**
     * @var string
     *
     * @ORM\Column(name="duree_prevue", type="string", length=500, nullable=false)
     */
    private $dureePrevue;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=500, nullable=false)
     */
    private $details;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;


}
