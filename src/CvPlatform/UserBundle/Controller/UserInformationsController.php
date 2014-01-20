<?php

namespace CvPlatform\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvPlatform\UserBundle\Form\Type\PersonalInformationType;
use CvPlatform\UserBundle\Entity\User;

class UserInformationsController extends Controller
{
    /**
     * @Route("/personal-informations", name="edit_user_personal_informations")
     */
    public function indexAction()
    {

        $user =  new User();
        $user->setLastname("Mir");
        $user->setUsername('mirmoze');
        $user->setEmail('mii@gmail.com');

        $form = $this->createForm(new PersonalInformationType(), $user);

        if (true === $this->processForm($form)) {
            return $this
                ->flush()
                ->successFlash('Informations updated')
                ->redirect(array("show_user_personal_informations"))
            ;
        }

        return $this->render(
            'CvPlatformUserBundle:Profile:personalInformations.html.twig',
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
