<?php
namespace CvPlatform\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mhor\CvToPdfBundle\Entity\SkillType as BaseSkillType;

/**
 * @ORM\Entity
 * @ORM\Table(name="skill_type")
 */
class SkillType extends BaseSkillType
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