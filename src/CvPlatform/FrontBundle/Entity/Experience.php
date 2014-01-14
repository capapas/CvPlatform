<?php
namespace CvPlatform\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mhor\CvToPdfBundle\Entity\Experience as BaseExperience;
use CvPlatform\UserBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="experience")
 */
class Experience extends BaseExperience
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(
     *  targetEntity="CvPlatform\UserBundle\Entity\User",
     *  inversedBy="experiences"
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