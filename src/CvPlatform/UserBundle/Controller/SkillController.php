<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CvPlatform\UserBundle\Form\Type\SkillType;
use CvPlatform\FrontBundle\Entity\Skill;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/profile")
 */
class SkillController extends Controller
{
    /**
     * @Route("/skills", name="edit_user_skill")
     */
    public function indexAction()
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $skills = $em->getRepository('CvPlatform\FrontBundle\Entity\Skill')->findBy(array('user' => $user));
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
     * @Route("/delete-skill/{id}", name="delete_user_skill")
     */
    public function deleteAction(Skill $skill)
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($skill->getUser() == $user) {
            $em->remove($skill);
            $em->flush();
        }

        $form = $this->createForm(new SkillType(), new Skill());
        return $this->render(
            'CvPlatformUserBundle:Profile:skill.html.twig',
            array(
                'skills' => $user->getSkills(),
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
