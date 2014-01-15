<?php

namespace CvPlatform\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mhor\CvToPdfBundle\Entity\Website as BaseWebsite;
use CvPlatform\UserBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="website")
 */
class Website extends BaseWebsite
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @var User
     * @ORM\ManyToOne(
     *  targetEntity="CvPlatform\UserBundle\Entity\User",
     *  inversedBy="websites"
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Set user
     *
     * @param User $user
     * @return Experience
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}