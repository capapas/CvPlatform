<?php
namespace CvPlatform\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use CvPlatform\FrontBundle\Entity\Lang;
use CvPlatform\UserBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="lang_level")
 */
class LangLevel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="CvPlatform\FrontBundle\Entity\Lang")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $lang;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      minMessage = "Vous niveau ne peut pas être inférieur à 1",
     *      maxMessage = "Vous ne devez pas dépasser 5"
     * )
     * 
     */
    private $level;

    /**
     * @var User
     * @ORM\ManyToOne(
     *  targetEntity="CvPlatform\UserBundle\Entity\User",
     *  inversedBy="langLevels"
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
     * Set level
     *
     * @param integer $level
     * @return LangLevel
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get libel
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set lang
     *
     * @param Lang $lang
     * @return LangLevel
     */
    public function setLang(Lang $lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return Lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return LangLevel
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
