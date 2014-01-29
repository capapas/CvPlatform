<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CvPlatform\UserBundle\Form\Type\PersonalInformationType;
use CvPlatform\UserBundle\Entity\User;
use CvPlatform\UserBundle\Form\Type\OthersInformationType;

/**
 * @Route("/profile")
 */
class UserInformationsController extends Controller
{
    /**
     * @Route("/personal-informations", name="edit_user_personal_informations")
     */
    public function indexAction()
    {

        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PersonalInformationType(), $user);

        if (true === $this->processForm($form)) {
            $em->flush();
            return $this->redirect($this->generateUrl("edit_user_personal_informations"));
        }

        return $this->render(
            'CvPlatformUserBundle:Profile:personalInformations.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/others-informations", name="edit_user_others_informations")
     */
    public function otherEditAction()
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new OthersInformationType(), $user);

        if (true === $this->processForm($form)) {
            $em->flush();
            return $this->redirect($this->generateUrl("edit_user_others_informations"));
        }

        return $this->render(
            'CvPlatformUserBundle:Profile:othersInformations.html.twig',
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
                $this->get('session')->getFlashBag()->add('error', 'flash.error');
            }
        }
        return false;
    }
}
