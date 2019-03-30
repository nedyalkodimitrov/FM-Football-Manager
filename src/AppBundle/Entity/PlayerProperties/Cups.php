<?php

namespace AppBundle\Entity\PlayerProperties;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cups
 *
 * @ORM\Table(name="player_properties_cups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerProperties\CupsRepository")
 */
class Cups
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
     * @ORM\Column(name="cupName", type="string", length=255)
     */
    private $cupName;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Division", inversedBy="cups")
     * @ORM\JoinColumn(name="division_id", referencedColumnName="id")
     */
    private $divisions;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Players", mappedBy="cups")
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
    public function getCupName()
    {
        return $this->cupName;
    }

    /**
     * @param string $cupName
     */
    public function setCupName($cupName)
    {
        $this->cupName = $cupName;
    }

    /**
     * @return mixed
     */
    public function getDivisions()
    {
        return $this->divisions;
    }

    /**
     * @param mixed $divisions
     */
    public function setDivisions($divisions)
    {
        $this->divisions = $divisions;
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

