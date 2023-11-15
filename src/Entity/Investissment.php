<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Investissment
 *
 * @ORM\Table(name="investissment")
 * @ORM\Entity
 */
class Investissment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_inv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInv;

    /**
     * @var int
     *
     * @ORM\Column(name="montant", type="integer", nullable=false)
     */
    private $montant;

    /**
     * @var int
     *
     * @ORM\Column(name="date_deb_inv", type="integer", nullable=false)
     */
    private $dateDebInv;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="id_entreprise", type="integer", nullable=false)
     */
    private $idEntreprise;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_prevue", type="integer", nullable=false)
     */
    private $dureePrevue;

    /**
     * @var int
     *
     * @ORM\Column(name="detail", type="integer", nullable=false)
     */
    private $detail;

    /**
     * @var int
     *
     * @ORM\Column(name="id_investisseur", type="integer", nullable=false)
     */
    private $idInvestisseur;


}
