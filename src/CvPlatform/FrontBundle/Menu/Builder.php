<?php
namespace CvPlatform\FrontBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'navbar' => true,
        ));

        $menu->addChild('Sign In', array('route' => 'fos_user_security_login'));
        $menu->addChild('Sign up', array('route' => 'fos_user_registration_register'));
        $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        return $menu;

    }
}
