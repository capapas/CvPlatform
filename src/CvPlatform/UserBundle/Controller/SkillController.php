<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CvPlatform\UserBundle\Form\Type\SkillType;
use CvPlatform\FrontBundle\Entity\Skill;

class SkillController extends Controller
{
    /**
     * @Route("/skills", name="edit_user_skill")
     */
    public function indexAction()
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $skills = $em->getRepository('CvPlatform\FrontBundle\Entity\Skill')->findAll();
        $skill =  new Skill();
        $form = $this->createForm(new SkillType(), $skill);

        if (true === $this->processForm($form)) {
            $skill->setUser($user);
            $em->persist($skill);
            $em->flush();
            return $this->redirect($this->generateUrl("edit_user_skill"));
        }

        return $this->render(
            'CvPlatformUserBundle:Profile:skill.html.twig',
            array(
                'skills' => $skills,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/delete-skill", name="delete_user_skill")
     */
    public function deleteAction()
    {

        $exp =  new Skill();

        $form = $this->createForm(new SkillType(), $exp);
        return $this->render(
            'CvPlatformUserBundle:Profile:skill.html.twig',
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
