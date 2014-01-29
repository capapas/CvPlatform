<?php

namespace CvPlatform\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('CvPlatformFrontBundle::index.html.twig');
    }

    /**
     * @Route("profile/my-profile", name="my_profile")
     */
    public function myProfileAction()
    {
        $currentUser= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CvPlatform\UserBundle\Entity\User')->find($currentUser);
        return $this->render('CvPlatformUserBundle:Profile:overview.html.twig', array('user' => $user));
    }
}
