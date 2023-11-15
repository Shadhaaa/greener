<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQUE_client_id", columns={"clientId"})})
 * @ORM\Entity
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="panierId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $panierid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="clientId", type="integer", nullable=true)
     */
    private $clientid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="produitId", type="integer", nullable=true)
     */
    private $produitid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var float|null
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=true)
     */
    private $total;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Nomproduit", type="string", length=255, nullable=true)
     */
    private $nomproduit;


}
