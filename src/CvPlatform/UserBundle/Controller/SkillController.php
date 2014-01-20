<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvPlatform\UserBundle\Form\Type\SkillType;
use CvPlatform\FrontBundle\Entity\Skill;

class SkillController extends Controller
{
    /**
     * @Route("/skills", name="edit_user_skill")
     */
    public function indexAction()
    {

        $skill =  new Skill();

        $form = $this->createForm(new SkillType(), $skill);

        if (true === $this->processForm($form)) {
            return $this
                ->flush()
                ->successFlash('Skills updated')
                ->redirect(array("edit_user_skill"))
            ;
        }

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
