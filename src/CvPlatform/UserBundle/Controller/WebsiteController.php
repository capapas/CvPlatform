<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CvPlatform\UserBundle\Form\Type\WebsiteType;
use CvPlatform\FrontBundle\Entity\Website;

class WebsiteController extends Controller
{
    /**
     * @Route("/websites", name="edit_user_website")
     */
    public function indexAction()
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $websites = $em->getRepository('CvPlatform\FrontBundle\Entity\Website')->findAll();
        $website =  new Website();
        $form = $this->createForm(new WebsiteType(), $website);

        if (true === $this->processForm($form)) {
            $website->setUser($user);
            $em->persist($website);
            $em->flush();
            return $this->redirect($this->generateUrl("edit_user_website"));
        }

        return $this->render(
            'CvPlatformUserBundle:Profile:website.html.twig',
            array(
                'websites' => $websites,
                'form' => $form->createView(),
            )
        );

    }

    /**
     * @Route("/delete-website", name="delete_user_website")
     * @Method({"POST"})
     */
    public function deleteAction()
    {
        $exp =  new Website();

        $form = $this->createForm(new WebsiteType(), $exp);
        return $this->render(
            'CvPlatformUserBundle:Profile:website.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    protected function processForm($form)
    {
        $request = $this->getRequest();

        if (!$request->isMethodSafe()) {

            $form->submit($request);

            if (true === $form->isValid()) {
                return true;
            }
            else {
                $this->errorFlash('flash.error');
            }
        }

        return false;
    }
}
