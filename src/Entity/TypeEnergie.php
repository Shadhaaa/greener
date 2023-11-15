<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeEnergie
 *
 * @ORM\Table(name="type_energie")
 * @ORM\Entity
 */
class TypeEnergie
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
     * @ORM\Column(name="pollution_par_kwh", type="integer", nullable=false)
     */
    private $pollutionParKwh;


}
