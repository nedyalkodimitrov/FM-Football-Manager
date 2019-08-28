<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Players
 *
 * @ORM\Table(name="players")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayersRepository")
 */
class Players
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
     * @var int
     *
     * @ORM\Column(name="phone", type="string", unique=true)
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country", inversedBy="players")
     * @ORM\JoinColumn(name="country", referencedColumnName="id")
     */
    private $country;



    /**
     * @var date
     *
     * @ORM\Column(name="birthDay", type="date", nullable=true)
     */
    private $birthDay;

    /**
     *  @ORM\OneToOne(targetEntity="AppBundle\Entity\PlayerProperties\PlayerStats")
     * @ORM\JoinColumn(name="stats_id", referencedColumnName="id")
     */
    private $stats;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teams", inversedBy="players")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;


    /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="Users", inversedBy="player")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private  $userId;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PlayerProperties\Positions", inversedBy="players")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PlayerProperties\Cups", inversedBy="players")
     * @ORM\JoinColumn(name="cup_id", referencedColumnName="id")
     */
    private $cups;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PlayerProperties\Food", inversedBy="players")
     * @ORM\JoinColumn(name="food_id", referencedColumnName="id")
     */
    private $food;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\YouthTeams", inversedBy="players")
     * @ORM\JoinColumn(name="youthTeam_id", referencedColumnName="id")
     */
    private $youthTeams;

    /**
     * @Assert\Image(
     *     allowLandscape = false,
     *     allowPortrait = false
     * )
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    public $image;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer", nullable=true   )
     */
    public $status;

    /**
     * @var string
     *
     * @ORM\Column(name="statusInformation", type="string", nullable=true)
     */
    public $statusInformation;

    /**
     * Many Users have Many Users.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PlayersInjured", mappedBy="users")
     */
    private $treatmentInformation;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Players")
     * @ORM\JoinTable(name="player_To_Player_Request",
     *      joinColumns={@ORM\JoinColumn(name="from_player", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="to_player", referencedColumnName="id")}
     *      )
     */
    private $playerToPlayerRequest;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Teams")
     * @ORM\JoinTable(name="player_To_Team_Request",
     *      joinColumns={@ORM\JoinColumn(name="from_player", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="to_team", referencedColumnName="id")}
     *      )
     */
    private $playerToTeamRequest;

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
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param mixed $stats
     */
    public function setStats($stats)
    {
        $this->stats = $stats;
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

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return date
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * @param date $birthDay
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;
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
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
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
    public function getFood()
    {
        return $this->food;
    }

    /**
     * @param mixed $food
     */
    public function setFood($food)
    {
        $this->food = $food;
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
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
    public function getStatusInformation()
    {
        return $this->statusInformation;
    }

    /**
     * @param string $statusInformation
     */
    public function setStatusInformation($statusInformation)
    {
        $this->statusInformation = $statusInformation;
    }

    /**
     * @return mixed
     */
    public function getTreatmentInformation()
    {
        return $this->treatmentInformation;
    }

    /**
     * @param mixed $treatmentInformation
     */
    public function setTreatmentInformation($treatmentInformation)
    {
        $this->treatmentInformation = $treatmentInformation;
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

    /**
     * @return mixed
     */
    public function getPlayerToPlayerRequest()
    {
        return $this->playerToPlayerRequest;
    }

    /**
     * @param mixed $playerToPlayerRequest
     */
    public function setPlayerToPlayerRequest($playerToPlayerRequest)
    {
        $this->playerToPlayerRequest = $playerToPlayerRequest;
    }

    /**
     * @return mixed
     */
    public function getPlayerToTeamRequest()
    {
        return $this->playerToTeamRequest;
    }

    /**
     * @param mixed $playerToTeamRequest
     */
    public function setPlayerToTeamRequest($playerToTeamRequest)
    {
        $this->playerToTeamRequest = $playerToTeamRequest;
    }

    public function _toString(){
        return $this->userId->name;
    }


}

