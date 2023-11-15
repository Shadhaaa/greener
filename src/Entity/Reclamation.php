<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=256, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=256, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=256, nullable=false, options={"comment"="il faut sairi @"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="screenshot", type="string", length=256, nullable=false)
     */
    private $screenshot;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_mobile", type="string", length=256, nullable=false)
     */
    private $numeroMobile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_traitement", type="date", nullable=false)
     */
    private $dateTraitement;

    /**
     * @var string
     *
     * @ORM\Column(name="nomServcie", type="string", length=256, nullable=false)
     */
    private $nomservcie;


}
