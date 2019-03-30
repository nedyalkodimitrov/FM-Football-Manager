<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersCups
 *
 * @ORM\Table(name="users_cups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersCupsRepository")
 */
class UsersCups
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Users", inversedBy="cups")
     * @ORM\JoinTable(name="users_cups_information")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Division")
     * @ORM\JoinTable(name="cups",
     *      joinColumns={@ORM\JoinColumn(name="cup", referencedColumnName="id", nullable=true)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="division", referencedColumnName="id", nullable=true)}
     *      )
     */
    protected  $cups;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\PlayerProperties\Cups")
     * @ORM\JoinTable(name="youthCups",
     *      joinColumns={@ORM\JoinColumn(name="cup", referencedColumnName="id", nullable=true )},
     *      inverseJoinColumns={@ORM\JoinColumn(name="youthCup", referencedColumnName="id", nullable=true)}
     *      )
     */
    protected $youthCups;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    protected $date;

    /**
     * UsersCups constructor.
     */
    public function __construct()
    {
        $this->userId = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->youthCups = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function getCups()
    {
        return $this->cups;
    }

    /**
     * @param mixed $cups
     */
    public function setCups($cups)
    {
        $this->cups = $cups;
    }

    /**
     * @return mixed
     */
    public function getYouthCups()
    {
        return $this->youthCups;
    }

    /**
     * @param mixed $youthCups
     */
    public function setYouthCups($youthCups)
    {
        $this->youthCups = $youthCups;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}

