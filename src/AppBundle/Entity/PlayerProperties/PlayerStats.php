<?php

namespace AppBundle\Entity\PlayerProperties;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerStats
 *
 * @ORM\Table(name="player_properties_player_stats")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerProperties\PlayerStatsRepository")
 */
class PlayerStats
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Players")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;



    /**
     * @var float
     *
     * @ORM\Column(name="statusFromCoaches", type="float", nullable=true)
     */
    private $statusFromCoaches;


    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float", nullable=true)
     */
    private $weight;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    private $height;


    /**
     * @var float
     *
     * @ORM\Column(name="fat", type="float", nullable=true)
     */
    private $fat;


    /**
     * @var float
     *
     * @ORM\Column(name="pace", type="float", nullable=true)
     */
    private $pace;


    /**
     * @var float
     *
     * @ORM\Column(name="tacticks", type="float", nullable=true)
     */
    private $tacticks;


    /**
     * @var float
     *
     * @ORM\Column(name="technique", type="float", nullable=true)
     */
    private $technique;

    /**
     * @var float
     *
     * @ORM\Column(name="pass", type="float", nullable=true)
     */
    private $pass;

    /**
     * @var float
     *
     * @ORM\Column(name="shot", type="float", nullable=true)
     */
    private $shot;

    /**
     * @var float
     *
     * @ORM\Column(name="dribble", type="float", nullable=true)
     */
    private $dribble;

    /**
     * @var float
     *
     * @ORM\Column(name="longPass", type="float", nullable=true)
     */
    private $longPass;

    /**
     * @var float
     *
     * @ORM\Column(name="relax", type="float", nullable=true)
     */
    private $relax;

    /**
     * @var float
     *
     * @ORM\Column(name="willpower", type="float", nullable=true)
     */
    private $willpower;


    /**
     * @var float
     *
     * @ORM\Column(name="work", type="float", nullable=true)
     */
    private $work;
    /**
     * @var float
     *
     * @ORM\Column(name="perspective", type="float", nullable=true)
     */
    private $perspective;



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
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return float
     */
    public function getStatusFromCoaches()
    {
        return $this->statusFromCoaches;
    }

    /**
     * @param float $statusFromCoaches
     */
    public function setStatusFromCoaches($statusFromCoaches)
    {
        $this->statusFromCoaches = $statusFromCoaches;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getFat()
    {
        return $this->fat;
    }

    /**
     * @param float $fat
     */
    public function setFat($fat)
    {
        $this->fat = $fat;
    }

    /**
     * @return float
     */
    public function getPace()
    {
        return $this->pace;
    }

    /**
     * @param float $pace
     */
    public function setPace($pace)
    {
        $this->pace = $pace;
    }

    /**
     * @return float
     */
    public function getTacticks()
    {
        return $this->tacticks;
    }

    /**
     * @param float $tacticks
     */
    public function setTacticks($tacticks)
    {
        $this->tacticks = $tacticks;
    }

    /**
     * @return float
     */
    public function getTechnique()
    {
        return $this->technique;
    }

    /**
     * @param float $technique
     */
    public function setTechnique($technique)
    {
        $this->technique = $technique;
    }

    /**
     * @return float
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param float $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return float
     */
    public function getShot()
    {
        return $this->shot;
    }

    /**
     * @param float $shot
     */
    public function setShot($shot)
    {
        $this->shot = $shot;
    }

    /**
     * @return float
     */
    public function getDribble()
    {
        return $this->dribble;
    }

    /**
     * @param float $dribble
     */
    public function setDribble($dribble)
    {
        $this->dribble = $dribble;
    }

    /**
     * @return float
     */
    public function getLongPass()
    {
        return $this->longPass;
    }

    /**
     * @param float $longPass
     */
    public function setLongPass($longPass)
    {
        $this->longPass = $longPass;
    }

    /**
     * @return float
     */
    public function getRelax()
    {
        return $this->relax;
    }

    /**
     * @param float $relax
     */
    public function setRelax($relax)
    {
        $this->relax = $relax;
    }

    /**
     * @return float
     */
    public function getWillpower()
    {
        return $this->willpower;
    }

    /**
     * @param float $willpower
     */
    public function setWillpower($willpower)
    {
        $this->willpower = $willpower;
    }

    /**
     * @return float
     */
    public function getWork()
    {
        return $this->work;
    }

    /**
     * @param float $work
     */
    public function setWork($work)
    {
        $this->work = $work;
    }

    /**
     * @return float
     */
    public function getPerspective()
    {
        return $this->perspective;
    }

    /**
     * @param float $perspective
     */
    public function setPerspective($perspective)
    {
        $this->perspective = $perspective;
    }


}

