<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersRepository")
 */
class Users implements UserInterface, \Serializable

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
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;


    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true, nullable=true)
     */


    private $email;


    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    public  $name;


    /**
     * @var string
     *
     * @ORM\Column(name="fName", type="string", length=255)
     */
    private  $fName;


    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role")
     * @ORM\JoinTable(name="user_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     * @var Collection\Role[]
     */
    private  $roles;




    /**
     * Many Users have Many Users.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\UsersCups", mappedBy="users")
     */
    private $cups;




    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Coaches", mappedBy="userId")
     */
    private $coaches;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Admins", mappedBy="userId")
     */
    private $admin;


    /**
     * @ORM\OneToOne(targetEntity="Players", mappedBy="userId")
     */
    private $player;

    /**
     * Users constructor.
     * @param coaches
     */
    public function __construct(array $roles = [])
    {
//        $this->player = new ArrayCollection();
//        $this->cups = new ArrayCollection();
        $this->roles = new ArrayCollection();
//        $this->coaches = new ArrayCollection();
//        $this->admin = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

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

    public function setFName($fName)
    {
        $this->fName= $fName;

        return $this;
    }

    /**
     * Get fName
     *
     * @return string
     */
    public function getFName()
    {
        return $this->fName;
    }

    /**
     * @return mixed
     */
    public function getCoaches()
    {
        return $this->coaches;
    }


    /**
     * @return mixed
     */
    public function getCups()
    {
        return $this->cups;
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
     * @param Collection\Role[] $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param mixed $coaches
     */
    public function setCoaches($coaches)
    {
        $this->coaches = $coaches;
    }



    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }


    public function getRoles()
    {
        $roles = [];
        foreach ( $this->roles as $role ) {
            $roles[] = $role->getName();
        }

        return $roles;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

}

