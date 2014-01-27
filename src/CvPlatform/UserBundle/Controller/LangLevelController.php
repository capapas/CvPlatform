<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvPlatform\UserBundle\Form\Type\LangLevelType;
use CvPlatform\FrontBundle\Entity\LangLevel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class LangLevelController extends Controller
{
    /**
     * @Route("/langs", name="edit_user_lang")
     */
    public function indexAction()
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $langs = $em->getRepository('CvPlatform\FrontBundle\Entity\LangLevel')->findBy(array('user' => $user));
        $lang =  new LangLevel();
        $form = $this->createForm(new LangLevelType(), $lang);

        if (true === $this->processForm($form)) {
            $lang->setUser($user);
            $em->persist($lang);
            $em->flush();
            return $this->redirect($this->generateUrl("edit_user_lang"));
        }

        return $this->render(
            'CvPlatformUserBundle:Profile:lang.html.twig',
            array(
                'langs' => $langs,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/delete-lang/{id}", name="delete_user_lang")
     */
    public function deleteAction(LangLevel $langLevel)
    {

        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($langLevel->getUser() == $user) {
            $em->remove($langLevel);
            $em->flush();
        }

        $form = $this->createForm(new LangLevelType(), new LangLevel());
        return $this->render(
            'CvPlatformUserBundle:Profile:lang.html.twig',
            array(
                'langs' => $user->getLangLevels(),
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
