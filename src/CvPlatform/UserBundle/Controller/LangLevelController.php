<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvPlatform\UserBundle\Form\Type\LangLevelType;
use CvPlatform\FrontBundle\Entity\LangLevel;

class LangLevelController extends Controller
{
    /**
     * @Route("/langs", name="edit_user_lang")
     */
    public function indexAction()
    {

        $lang =  new LangLevel();
        $form = $this->createForm(new LangLevelType(), $lang);

        if (true === $this->processForm($form)) {
            return $this
                ->flush()
                ->successFlash('Informations updated')
                ->redirect(array("edit_user_lang"))
            ;
        }

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
                $this->errorFlash('flash.error');
            }
        }

        return false;
    }
}
