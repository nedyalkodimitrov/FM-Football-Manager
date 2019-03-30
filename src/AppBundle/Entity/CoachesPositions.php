<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoachesPositions
 *
 * @ORM\Table(name="coaches_positions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoachesPositionsRepository")
 */
class CoachesPositions
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
     * @ORM\Column(name="position", type="string")
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Coaches", mappedBy="teamPosition")
     *
     */
    private $coaches;

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
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
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


}

