<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvPlatform\FrontBundle\Entity\Experience;
use CvPlatform\UserBundle\Form\Type\ExperienceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/profile")
 */
class ExperienceController extends Controller
{
    /**
     * @Route("/experiences", name="edit_user_experience")
     */
    public function indexAction()
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $experiences = $em->getRepository('CvPlatform\FrontBundle\Entity\Experience')->findBy(array('user' => $user));
        $exp =  new Experience();
        $form = $this->createForm(new ExperienceType(), $exp);

        if (true === $this->processForm($form)) {
            $exp->setUser($user);
            $em->persist($exp);
            $em->flush();
            return $this->redirect($this->generateUrl("edit_user_experience"));
        }

        return $this->render(
            'CvPlatformUserBundle:Profile:experience.html.twig',
            array(
                'experiences' => $experiences,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/delete-experience/{id}", name="delete_user_experience")
     */
    public function deleteAction(Experience $exp)
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($exp->getUser() == $user) {
            $em->remove($exp);
            $em->flush();
        }
        $form = $this->createForm(new ExperienceType(), new Experience());
        return $this->render(
            'CvPlatformUserBundle:Profile:experience.html.twig',
            array(
                'experiences' => $user->getExperiences(),
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
