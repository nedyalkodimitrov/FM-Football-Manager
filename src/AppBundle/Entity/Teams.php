<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Teams
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamsRepository")
 */
class Teams
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
     * @ORM\Column(name="name", type="string", length=255, unique=true, nullable=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer", nullable=true)
     */
    private $points;

    /**
     * @var int
     *
     * @ORM\Column(name="played_games", type="integer", nullable=true)
     */
    private $playedGames;

    /**
     * @var int
     *
     * @ORM\Column(name="wins", type="integer", nullable=true)
     */
    private $wins;

    /**
     * @var int
     *
     * @ORM\Column(name="lostGames", type="integer", nullable=true)
     */
    private $lostGames;


    /**
     * @var int
     *
     * @ORM\Column(name="drawsGames", type="integer", nullable=true)
     */
    private $drawsGames;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Division", inversedBy="teams")
     * @ORM\JoinColumn(name="division_id", referencedColumnName="id")
     */
    private $devision;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\YouthTeams", mappedBy="motherTeam")
     */
    private $youthTeams;


    /**
     * @var int
     *
     * @ORM\Column(name="goals", type="integer", nullable=true)
     */
    private $goals;

    /**
     * @var int
     *
     * @ORM\Column(name="goalsInTheTeamDoor", type="integer", nullable=true)
     */
    private $goalsInTheTeamDoor;

    /**
     * Many Categories have One Category.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Coaches", mappedBy="team")
     */
    private $coaches;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Admins", mappedBy="team")
     */
    private $admin;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Players", mappedBy="team")
     */
    private $players;


    /**
     * @Assert\Image(
     *     allowLandscape = false,
     *     allowPortrait = false
     * )
     * @ORM\Column(name="image", type="string", nullable=true)
     */

    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country", inversedBy="teams")
     * @ORM\JoinColumn(name="country", referencedColumnName="id")
     */
    private $country;


//    /**
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeamCups", mappedBy="team")
//     */
//    private $cups;
//    /**
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeamCoacheRegister", mappedBy="teams")
//     */
//    private $teamCoacheRegister;
//
//    /**
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeamPlayerRegister", mappedBy="teams")
//     */
//    private $teamPlayerRegister;





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
     * @return mixed
     */
    public function getDevision()
    {
        return $this->devision;
    }

    /**
     * @param mixed $devision
     */
    public function setDevision($devision)
    {
        $this->devision = $devision;
    }

    /**
     * @return mixed
     */
    public function getYouthTeams()
    {
        return $this->youthTeams;
    }

    /**
     * @param mixed $youthTeams
     */
    public function setYouthTeams($youthTeams)
    {
        $this->youthTeams = $youthTeams;
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
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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

