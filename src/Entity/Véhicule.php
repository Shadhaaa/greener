<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Véhicule
 *
 * @ORM\Table(name="véhicule")
 * @ORM\Entity
 */
class Véhicule
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libellet", type="string", length=255, nullable=false)
     */
    private $libellet;

    /**
     * @var int
     *
     * @ORM\Column(name="pollution/km", type="integer", nullable=false)
     */
    private $pollution_km;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255, nullable=false)
     */
    private $marque;
}
