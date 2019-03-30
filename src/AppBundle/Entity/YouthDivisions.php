<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * YouthDivisions
 *
 * @ORM\Table(name="youth_divisions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\YouthDivisionsRepository")
 */
class YouthDivisions
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country", inversedBy="youthDivisions")
     * @ORM\JoinColumn(name="country", referencedColumnName="id")
     */
    private $country;


    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\YouthTeams", mappedBy="division")
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

//    /**
//     * @ORM\OneToOne(targetEntity="AppBundle\Entity\YouthTeamCups", mappedBy="divisions")
//     */
//    private $cups;


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
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
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


}

