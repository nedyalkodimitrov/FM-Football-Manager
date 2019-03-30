<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coaches
 *
 * @ORM\Table(name="coaches")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoachesRepository")
 */
class Coaches
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
     * @ORM\Column(name="phone", type="string")
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\YouthTeams", inversedBy="coaches")
     * @ORM\JoinColumn(name="youth_team_id", referencedColumnName="id")
     */
    private $youthTeam;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teams", inversedBy="coaches")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Schedule", mappedBy="coaches")
     *
     */
    private $schedule;


    /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="Users", inversedBy="coaches")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private  $userId;


    /**
     * @var date
     *
     * @ORM\Column(name="birthDay", type="date", nullable=true)
     */
    private $birthDay;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PlayerProperties\Positions")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CoachesPositions", inversedBy="coaches")
     * @ORM\JoinColumn(name="teamPosition_id", referencedColumnName="id")
     */
    private $teamPosition;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    public $image;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    public $status;

    /**
     * Many Users have Many Users.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CoacheStatus", mappedBy="users")
     */
    private $treatmentInformation;
//
//    /**
//     * Many Users have Many Users.
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\YouthTeamCoacheRegister", mappedBy="coaches")
//     */
//    private $youthTeamCoacheRegister;
//    /**
//     * Many Users have Many Users.
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeamCoacheRegister", mappedBy="coaches")
//     */
//    private $teamCoacheRegister;

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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getYouthTeam()
    {
        return $this->youthTeam;
    }

    /**
     * @param mixed $youthTeam
     */
    public function setYouthTeam($youthTeam)
    {
        $this->youthTeam = $youthTeam;
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
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param mixed $schedule
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
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
    public function getTeamPosition()
    {
        return $this->teamPosition;
    }

    /**
     * @param mixed $teamPosition
     */
    public function setTeamPosition($teamPosition)
    {
        $this->teamPosition = $teamPosition;
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
}

