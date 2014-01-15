<?php

namespace CvPlatform\UserBundle\Entity;

use Mhor\CvToPdfBundle\Entity\Person;
use CvPlatform\FrontBundle\Entity\Experience;
use CvPlatform\FrontBundle\Entity\Website;
use CvPlatform\FrontBundle\Entity\LangLevel;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="cvplatform_user")
 * @ORM\Entity(repositoryClass="CvPlatform\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser implements Person
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime",nullable=true)
     */
    protected $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=10, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="cellphone", type="string", length=10, nullable=true)
     */
    protected $cellphone;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    protected $street;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=5, nullable=true)
     */
    protected $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", nullable=true)
     */
    protected $country;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *  targetEntity="CvPlatform\FrontBundle\Entity\LangLevel",
     *  mappedBy="user"
     * )
     *
     */
    protected $langLevels;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *  targetEntity="CvPlatform\FrontBundle\Entity\Website",
     *  mappedBy="user"
     * )
     *
     */
    protected $websites;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *  targetEntity="CvPlatform\FrontBundle\Entity\Experience",
     *  mappedBy="user"
     * )
     *
     */
    protected $experiences;

    public function __construct()
    {
        $this->experiences = new ArrayCollection();
        $this->websites = new ArrayCollection();
        $this->langLevels = new ArrayCollection();
    }

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
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return User
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set cellphone
     *
     * @param string $cellphone
     * @return User
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    /**
     * Get cellphone
     *
     * @return string
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return User
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set country
     *
     * @param string $zipcode
     * @return User
     */
    public function setCountry($country)
    {
        $this->zipcode = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function addExperience(Experience $experience)
    {
        $this->experiences[] = $experience;
        return $this;
    }

    public function removeExperience(Experience $experience)
    {
        $this->experiences->removeElement($experience);
    }

    public function getExperiences()
    {
        return $this->experiences;
    }

    public function addWebsite(Website $website)
    {
        $this->websites[] = $website;
        return $this;
    }

    public function removeWebsite(Website $website)
    {
        $this->websites->removeElement($website);
    }

    public function getWebsites()
    {
        return $this->websites;
    }

    public function addLangLevel(LangLevel $langLevel)
    {
        $this->langLevels[] = $langLevel;
        return $this;
    }

    public function removeLangLevel(LangLevel $langLevel)
    {
        $this->langLevels->removeElement($langLevel);
    }

    public function getLangLevels()
    {
        return $this->langLevels;
    }
}
