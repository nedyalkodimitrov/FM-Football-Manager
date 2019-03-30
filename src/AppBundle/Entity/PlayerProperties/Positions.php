<?php

namespace AppBundle\Entity\PlayerProperties;

use Doctrine\ORM\Mapping as ORM;

/**
 * Positions
 *
 * @ORM\Table(name="player_properties_positions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerProperties\PositionsRepository")
 */
class Positions
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
     * @var string
     *
     * @ORM\Column(name="positions", type="string", length=255, unique=true)
     */
    private $positions;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Players", mappedBy="position")
     */
    private $players;


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
     * @return string
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * @param string $positions
     */
    public function setPositions($positions)
    {
        $this->positions = $positions;
    }

    /**
     * @return mixed
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param mixed $players
     */
    public function setPlayers($players)
    {
        $this->players = $players;
    }


}

