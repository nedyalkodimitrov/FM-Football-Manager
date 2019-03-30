<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admins
 *
 * @ORM\Table(name="admins")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdminsRepository")
 */
class Admins
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teams", inversedBy="admin")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;

    /**
     * @var int
     *
     * @ORM\Column(name="phone", type="string", unique=true)
     */
    private $phone;


    /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Users", inversedBy="admin")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private  $userId;

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
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }



}

