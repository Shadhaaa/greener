<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=20, nullable=true)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pdp", type="string", length=200, nullable=true)
     */
    private $pdp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="num", type="integer", nullable=true)
     */
    private $num;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=true)
     */
    private $mail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mdp1", type="string", length=20, nullable=true)
     */
    private $mdp1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=25, nullable=true)
     */
    private $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="genre", type="string", length=20, nullable=true)
     */
    private $genre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="investisseur_inv", type="text", length=0, nullable=true)
     */
    private $investisseurInv;


}
