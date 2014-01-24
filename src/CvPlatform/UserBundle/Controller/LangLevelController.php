<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvPlatform\UserBundle\Form\Type\LangLevelType;
use CvPlatform\FrontBundle\Entity\LangLevel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class LangLevelController extends Controller
{
    /**
     * @Route("/langs", name="edit_user_lang")
     */
    public function indexAction()
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $langs = $em->getRepository('CvPlatform\FrontBundle\Entity\LangLevel')->findAll();
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
     * @Route("/delete-lang", name="delete_user_lang")
     * @Method({"POST"})
     */
    public function deleteAction()
    {

        $exp =  new Lang();

        $form = $this->createForm(new LangType(), $exp);
        return $this->render(
            'CvPlatformUserBundle:Profile:lang.html.twig',
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
                //$this->errorFlash('flash.error');
            }
        }

        return false;
    }
}
