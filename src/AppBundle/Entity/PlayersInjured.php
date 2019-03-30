<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayersInjured
 *
 * @ORM\Table(name="players_injured")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayersInjuredRepository")
 */
class PlayersInjured
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
     * One Product has One Shipment.
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Players", inversedBy="treatmentInformation")
     * @ORM\JoinColumn(name="users", referencedColumnName="id")
     */
    private  $users;


    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string")
     */
    private $status;


    /**
     * @var string
     *
     * @ORM\Column(name="medicaments", type="string")
     */
    private $medicaments;

    /**
     * @var string
     *
     * @ORM\Column(name="startTreatment", type="string")
     */
    private $startTreatment;

    /**
     * @var string
     *
     * @ORM\Column(name="endTreatment", type="string")
     */
    private $endTreatment;

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
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getMedicaments()
    {
        return $this->medicaments;
    }

    /**
     * @param string $medicaments
     */
    public function setMedicaments($medicaments)
    {
        $this->medicaments = $medicaments;
    }

    /**
     * @return string
     */
    public function getStartTreatment()
    {
        return $this->startTreatment;
    }

    /**
     * @param string $startTreatment
     */
    public function setStartTreatment($startTreatment)
    {
        $this->startTreatment = $startTreatment;
    }

    /**
     * @return string
     */
    public function getEndTreatment()
    {
        return $this->endTreatment;
    }

    /**
     * @param string $endTreatment
     */
    public function setEndTreatment($endTreatment)
    {
        $this->endTreatment = $endTreatment;
    }


}

