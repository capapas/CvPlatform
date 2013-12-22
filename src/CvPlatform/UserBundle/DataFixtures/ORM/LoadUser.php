<?php

namespace Cassini\TamUserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CvPlatform\UserBundle\Entity\User;

class LoadUser implements FixtureInterface, ContainerAwareInterface
{
    
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $noms = array(
            array("login" => 'mhor', 'lastname' => 'HORCHOLLE', 'firstname' => 'Maxime', 'isAdmin' => true),
            array("login" => 'daybay', 'lastname' => 'KELMENI', 'firstname' => 'Florim', 'isAdmin' => true),
            array("login" => 'user', 'lastname' => 'user', 'firstname' => 'user', 'isAdmin' => false),
            array("login" => 'admin', 'lastname' => 'admin', 'firstname' => 'admin', 'isAdmin' => true)
        );

        foreach ($noms as $i => $nom) {
            $users[$i] = new User();

            $users[$i]->setUsername($nom['login']);
            $users[$i]->setUsernameCanonical($nom['login']);
            $users[$i]->setEmail($nom['login'] . '@test.com');
            $users[$i]->setEmailCanonical($nom['login'] . '@test.com');
            $users[$i]->setFirstname($nom['firstname']);
            $users[$i]->setLastname($nom['lastname']);
                       
            $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($users[$i]);

            $users[$i]->setPassword($encoder->encodePassword($nom['login'], $users[$i]->getSalt()));

            $users[$i]->setEnabled(true);

            if ($nom['isAdmin']) {
                $users[$i]->setRoles(array('ROLE_ADMIN'));
            } else {
                $users[$i]->setRoles(array('ROLE_USER'));
            }

            $manager->persist($users[$i]);
        }

        $manager->flush();
    }
}
