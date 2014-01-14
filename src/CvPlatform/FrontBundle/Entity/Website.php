<?php

namespace CvPlatform\FrontBundle\Entity\Website;

use Doctrine\ORM\Mapping as ORM;
use Mhor\CvToPdfBundle\Entity\Website as BaseWebsite;

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
}