<?php

namespace AppBundle\Entity\PlayerProperties;

use Doctrine\ORM\Mapping as ORM;

/**
 * WaterGlasses
 *
 * @ORM\Table(name="player_properties_water_glasses")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerProperties\WaterGlassesRepository")
 */
class WaterGlasses
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $playerId;


    /**
     * @var int
     *
     * @ORM\Column(name="waterGlasses", type="integer")
     */
    private $waterGlasses;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="string")
     */
    private $date;

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
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * @param mixed $playerId
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;
    }

    /**
     * @return int
     */
    public function getWaterGlasses()
    {
        return $this->waterGlasses;
    }

    /**
     * @param int $waterGlasses
     */
    public function setWaterGlasses($waterGlasses)
    {
        $this->waterGlasses = $waterGlasses;
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

