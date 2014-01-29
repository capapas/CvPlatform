<?php

namespace CvPlatform\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route("profile/export_my_cv", name="export_my_cv")
     */
    public function exportCvAction()
    {
        $currentUser= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CvPlatform\UserBundle\Entity\User')->find($currentUser);
        $html = $this->renderView('CvPlatformUserBundle:Profile:export.html.twig', array('user' => $user));


        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="cv_' . $user->getUsername() . '.pdf"'
            )
        );
    }
}
