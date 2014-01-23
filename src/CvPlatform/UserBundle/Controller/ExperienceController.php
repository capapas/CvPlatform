<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvPlatform\FrontBundle\Entity\Experience;
use CvPlatform\UserBundle\Form\Type\ExperienceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ExperienceController extends Controller
{
    /**
     * @Route("/experiences", name="edit_user_experience")
     */
    public function indexAction()
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $experiences = $em->getRepository('CvPlatform\FrontBundle\Entity\Experience')->findAll();
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
     * @Route("/delete-experience", name="delete_user_experience")
     * @Method({"POST"})
     */
    public function deleteAction()
    {

        $exp =  new Experience();

        $form = $this->createForm(new ExperienceType(), $exp);
        return $this->render(
            'CvPlatformUserBundle:Profile:experience.html.twig',
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
