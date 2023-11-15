<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse", indexes={@ORM\Index(name="idReclamation", columns={"idReclamation"})})
 * @ORM\Entity
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReponse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreponse;

    /**
     * @var string
     *
     * @ORM\Column(name="Text", type="string", length=256, nullable=false)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=256, nullable=false)
     */
    private $status;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idReclamation", type="integer", nullable=true)
     */
    private $idreclamation;


}
