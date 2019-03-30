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

//    /**
//     * Many Users have Many Users.
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\YouthTeamPlayerRegister", mappedBy="players")
//     */
//    private $youthTeamPlayerRegister;
//    /**
//     * Many Users have Many Users.
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeamPlayerRegister", mappedBy="players")
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

    public function _toString(){
        return $this->userId->name;
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

