<?php
namespace CvPlatform\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @var string
     *
     * @ORM\Column(name="level", type="integer")
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
     * @param string $level
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
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set lang
     *
     * @param string $lang
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
        return $this->Lang;
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
