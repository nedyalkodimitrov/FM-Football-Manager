<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 */
class Country
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
     * @ORM\OneToMany(targetEntity="Players", mappedBy="country")
     */
    private $players;
    /**
     * @ORM\OneToMany(targetEntity="Teams", mappedBy="country")
     */
    private $teams;
    /**
     * @ORM\OneToMany(targetEntity="YouthTeams", mappedBy="country")
     */
    private $youthTeams;
    /**
     * @ORM\OneToMany(targetEntity="YouthDivisions", mappedBy="country")
     */
    private $youthDivisions;

    /**
     * @ORM\OneToMany(targetEntity="Division", mappedBy="country")
     */
    private $divisions;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="images", type="string", length=255, unique=true)
     */
    private $images;


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
     * Set name
     *
     * @param string $name
     *
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set images
     *
     * @param string $images
     *
     * @return Country
     */
    public function setImages($images)
    {
        $this->images = $images;
    
        return $this;
    }

    /**
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
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
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @param mixed $teams
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;
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
     * @return mixed
     */
    public function getYouthDivisions()
    {
        return $this->youthDivisions;
    }

    /**
     * @param mixed $youthDivisions
     */
    public function setYouthDivisions($youthDivisions)
    {
        $this->youthDivisions = $youthDivisions;
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


}

