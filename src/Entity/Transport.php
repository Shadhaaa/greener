<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transport
 *
 * @ORM\Table(name="transport")
 * @ORM\Entity
 */
class Transport
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="id_véhicule", type="integer", nullable=false)
     */
    private $idVéhicule;

    /**
     * @var float
     *
     * @ORM\Column(name="distance_tot", type="float", precision=10, scale=0, nullable=false)
     */
    private $distanceTot;

    /**
     * @var int
     *
     * @ORM\Column(name="id_transport", type="integer", nullable=false)
     */
    private $idTransport;


}
