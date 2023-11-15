<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitConsommeEnergie
 *
 * @ORM\Table(name="produit_consomme_energie")
 * @ORM\Entity
 */
class ProduitConsommeEnergie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pr_cons_en", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrConsEn;

    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     */
    private $idProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="id_energie", type="integer", nullable=false)
     */
    private $idEnergie;

    /**
     * @var int
     *
     * @ORM\Column(name="consommation_mentuelle", type="integer", nullable=false)
     */
    private $consommationMentuelle;


}
