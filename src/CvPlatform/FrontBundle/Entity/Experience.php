<?php
namespace CvPlatform\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mhor\CvToPdfBundle\Entity\Experience as BaseExperience;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}