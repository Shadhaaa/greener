<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity
 */
class Avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAvis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idavis;

    /**
     * @var string
     *
     * @ORM\Column(name="detailAvisService", type="string", length=255, nullable=false)
     */
    private $detailavisservice;

    /**
     * @var int
     *
     * @ORM\Column(name="noteService", type="integer", nullable=false)
     */
    private $noteservice;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;
}
