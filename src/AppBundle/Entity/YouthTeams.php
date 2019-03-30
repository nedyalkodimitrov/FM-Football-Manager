<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * YouthTeams
 *
 * @ORM\Table(name="youth_teams")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\YouthTeamsRepository")
 */
class YouthTeams
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var int
     *
     * @ORM\Column(name="played_games", type="integer")
     */
    private $playedGames;

    /**
     * @var int
     *
     * @ORM\Column(name="wins", type="integer")
     */
    private $wins;

    /**
     * @var int
     *
     * @ORM\Column(name="lostGames", type="integer")
     */
    private $lostGames;


    /**
     * @var int
     *
     * @ORM\Column(name="drawsGames", type="integer")
     */
    private $drawsGames;

    /**
     * @var int
     *
     * @ORM\Column(name="goals", type="integer")
     */
    private $goals;

    /**
     * @var int
     *
     * @ORM\Column(name="goalsInTheTeamDoor", type="integer")
     */
    private $goalsInTheTeamDoor;


   
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\YouthDivisions", inversedBy="youthTeams")
     * @ORM\JoinColumn(name="division_id", referencedColumnName="id")
     */
    private $division;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teams", inversedBy="youthTeams")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $motherTeam;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Players", mappedBy="youthTeams")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Coaches", mappedBy="youthTeam")
     */
    private $coaches;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country", inversedBy="youthTeams")
     * @ORM\JoinColumn(name="country", referencedColumnName="id")
     */
    private $country;





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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return int
     */
    public function getPlayedGames()
    {
        return $this->playedGames;
    }

    /**
     * @param int $playedGames
     */
    public function setPlayedGames($playedGames)
    {
        $this->playedGames = $playedGames;
    }

    /**
     * @return int
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     */
    public function setWins($wins)
    {
        $this->wins = $wins;
    }

    /**
     * @return int
     */
    public function getLostGames()
    {
        return $this->lostGames;
    }

    /**
     * @param int $lostGames
     */
    public function setLostGames($lostGames)
    {
        $this->lostGames = $lostGames;
    }

    /**
     * @return int
     */
    public function getDrawsGames()
    {
        return $this->drawsGames;
    }

    /**
     * @param int $drawsGames
     */
    public function setDrawsGames($drawsGames)
    {
        $this->drawsGames = $drawsGames;
    }

    /**
     * @return int
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * @param int $goals
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;
    }

    /**
     * @return int
     */
    public function getGoalsInTheTeamDoor()
    {
        return $this->goalsInTheTeamDoor;
    }

    /**
     * @param int $goalsInTheTeamDoor
     */
    public function setGoalsInTheTeamDoor($goalsInTheTeamDoor)
    {
        $this->goalsInTheTeamDoor = $goalsInTheTeamDoor;
    }

    /**
     * @return mixed
     */
    public function getMotherTeam()
    {
        return $this->motherTeam;
    }

    /**
     * @param mixed $motherTeam
     */
    public function setMotherTeam($motherTeam)
    {
        $this->motherTeam = $motherTeam;
    }

    /**
     * @return mixed
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * @param mixed $division
     */
    public function setDivision($division)
    {
        $this->division = $division;
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

    /**
     * @return mixed
     */
    public function getCoaches()
    {
        return $this->coaches;
    }

    /**
     * @param mixed $coaches
     */
    public function setCoaches($coaches)
    {
        $this->coaches = $coaches;
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
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }



}

