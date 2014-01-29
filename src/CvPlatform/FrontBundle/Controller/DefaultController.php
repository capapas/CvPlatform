<?php

namespace CvPlatform\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use CvPlatform\UserBundle\Entity\User;

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

        $pageUrl = $this->generateUrl('export_html_cv', array('id' => $user->getId()), true);

        return new Response(
            $this->get('knp_snappy.pdf')->getOutput($pageUrl),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );



        //$html = $this->renderView('CvPlatformUserBundle:Profile:export.html.twig', array('user' => $user));
/*
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="cv_' . $user->getUsername() . '.pdf"'
            )
        );*/
    }

     /**
      * @Route("show-profile/{id}", name="show_profile")
      */
    public function showProfileAction(User $user)
    {
        return $this->render('CvPlatformUserBundle:Profile:overview2.html.twig', array('user' => $user));
    }

    /**
     * @Route("/export-cv/{id}", name="export_html_cv")
     */
    public function exportHtmlCvAction(User $user)
    {
        return $this->render('CvPlatformUserBundle:Profile:export.html.twig', array('user' => $user));
    }
}