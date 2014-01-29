<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CvPlatform\UserBundle\Form\Type\WebsiteType;
use CvPlatform\FrontBundle\Entity\Website;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/profile")
 */
class WebsiteController extends Controller
{
    /**
     * @Route("/websites", name="edit_user_website")
     */
    public function indexAction()
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $websites = $em->getRepository('CvPlatform\FrontBundle\Entity\Website')->findBy(array('user' => $user));
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
     * @Route("/delete-website/{id}", name="delete_user_website")
     */
    public function deleteAction(Website $website)
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($website->getUser() == $user) {
            $em->remove($website);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('edit_user_website'));

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
                $this->get('session')->getFlashBag()->add('error', 'flash.error');
            }
        }

        return false;
    }
}
