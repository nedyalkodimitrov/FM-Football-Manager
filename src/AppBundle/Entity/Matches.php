<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matches
 *
 * @ORM\Table(name="matches")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatchesRepository")
 */
class Matches
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teams", inversedBy="home")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $home;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teams", inversedBy="away")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $away;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="startTime", type="string")
     */
  
    private $startTime;

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
    public function getHome()
    {
        return $this->home;
    }

    /**
     * @param mixed $home
     */
    public function setHome($home)
    {
        $this->home = $home;
    }

    /**
     * @return mixed
     */
    public function getAway()
    {
        return $this->away;
    }

    /**
     * @param mixed $away
     */
    public function setAway($away)
    {
        $this->away = $away;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }



}

