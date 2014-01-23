<?php
namespace CvPlatform\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mhor\CvToPdfBundle\Entity\Skill as BaseSkill;
use CvPlatform\UserBundle\Entity\User;
/**
 * @ORM\Entity
 * @ORM\Table(name="skill")
 */
class Skill extends BaseSkill
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
     *  inversedBy="skills"
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
