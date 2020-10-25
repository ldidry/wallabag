<?php

namespace Wallabag\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as FOSSecurityController;

/**
 * Extends login form in order to pass the registration_enabled parameter.
 */
class SecurityController extends FOSSecurityController
{
    protected function renderLogin(array $data)
    {
        /*
         * IS_AUTHENTICATED_REMEMBERED: "All logged in users have this"
         * https://symfony.com/doc/current/security.html#checking-to-see-if-a-user-is-logged-in-is-authenticated-fully
         */
        if (false === $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->render('FOSUserBundle:Security:login.html.twig',
                array_merge(
                    $data,
                    ['registration_enabled' => $this->container->getParameter('wallabag_user.registration_enabled')]
                )
            );
        } else {
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
}
