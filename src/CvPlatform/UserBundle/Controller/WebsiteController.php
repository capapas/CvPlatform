<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvPlatform\UserBundle\Form\Type\WebsiteType;
use CvPlatform\FrontBundle\Entity\Website;

class WebsiteController extends Controller
{
    /**
     * @Route("/websites", name="edit_user_website")
     */
    public function indexAction()
    {

        $website =  new Website();

        $form = $this->createForm(new WebsiteType(), $website);

        if (true === $this->processForm($form)) {
            return $this
                ->flush()
                ->successFlash('Websites updated')
                ->redirect(array("edit_user_website"))
            ;
        }

        return $this->render(
            'CvPlatformUserBundle:Profile:website.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    /**
     * @Route("/delete-website", name="delete_user_website")
     */
    public function deleteAction()
    {

        $exp =  new Website();

        $form = $this->createForm(new WebsiteType(), $exp);
        return $this->render(
            'CvPlatformUserBundle:Profile:website.html.twig',
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
