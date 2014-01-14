<?php
namespace CvPlatform\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mhor\CvToPdfBundle\Entity\Skill as BaseSkill;

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
}
