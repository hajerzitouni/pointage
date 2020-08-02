<?php
// src/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
/**
 * @ORM\Entity(repositoryClass="App\Repository\UsertestRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @Assert\NotBlank
     * @var string
     */
    protected $username;


    public function __construct()
    {
        parent::__construct();
        // your own logic
      $this->roles = array('ROLE_ADMIN');
        //$this->setSuperAdmin(true);
    }
    public function __toString()
    {
        return $this->username;

    }
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Societe", mappedBy ="users")
     * @ORM\JoinTable(name="user_societe")
     */

    private $societes;

    public function __construct2()
    {
        $this->societes = new ArrayCollection();
    }
}