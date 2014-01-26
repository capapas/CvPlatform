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
            'pull-right' => true
        ));

        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {

            $dropdown = $menu->addChild('Profile', array(
                'dropdown' => true,
                'caret' => true,
            ));

            $dropdown->addChild('Update Profile', array(
                'route' => 'edit_user_personal_informations'
                )
            );
            $dropdown->addChild('See my profile', array(
                'route' => 'my_profile'
                )
            );
            $dropdown->addChild('Logout', array(
                'route' => 'fos_user_security_logout'
                )
            );

        } else {

            $menu->addChild('Sign In', array(
                'route' => 'fos_user_security_login'
                )
            );

            $menu->addChild('Sign up', array(
                'route' => 'fos_user_registration_register'
                )
            );
        }
        return $menu;
    }

    public function resumeSideMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Personal Informations', array(
            'route' => 'edit_user_personal_informations',
        ));

        $menu->addChild('Websites', array(
            'route' => 'edit_user_website',
        ));

        $menu->addChild('Skills', array(
            'route' => 'edit_user_skill',
        ));

        $menu->addChild('Experiences', array(
            'route' => 'edit_user_experience',
        ));

        $menu->addChild('Langs', array(
            'route' => 'edit_user_lang',
        ));

        $menu->addChild('Others', array(
            'route' => 'edit_user_others_informations',
        ));

        return $menu;
    }
}
