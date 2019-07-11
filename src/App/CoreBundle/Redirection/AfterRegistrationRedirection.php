<?php

namespace App\CoreBundle\Redirection;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AfterRegistrationRedirection implements EventSubscriberInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * ResettingListener constructor.
     *
     * @param UrlGeneratorInterface $router
     * @param int                   $tokenTtl
     */
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => array('onFormSuccess'),
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => array('onChangePasswordSuccess' ),
            FOSUserEvents::PROFILE_EDIT_SUCCESS => array('onChangePasswordSuccess' ),
        );
    }

    public function onFormSuccess(FormEvent $event )
    {
        $user = $event->getForm()->getData();

        if($user->hasRole('ROLE_PARTENAIRE')) {
            $event->setResponse(new RedirectResponse($this->router->generate('web_partenaire_new')));   

        } else if($user->hasRole('ROLE_CLIENT')) {
            $event->setResponse(new RedirectResponse($this->router->generate('web_client_new')));           
        } else if($user->hasRole('ROLE_ADMIN') || $user->isSuperAdmin()) {
            $event->setResponse(new RedirectResponse($this->router->generate('admin_dashboard')));           
        } else {
            $redirection = new RedirectResponse($this->router->generate('homepage'));

        }
    }

    public function onChangePasswordSuccess(FormEvent $event )
    {
        $user = $event->getForm()->getData();

        if($user->hasRole('ROLE_PARTENAIRE') or $user->hasRole('ROLE_CLIENT')) {
            $event->setResponse(new RedirectResponse($this->router->generate('fos_user_profile_show')));   

        } else {
            $event->setResponse(new RedirectResponse($this->router->generate('admin_dashboard')));

        }

        // $event->setResponse(new RedirectResponse($this->router->generate('fos_user_profile_show')));   

    }
}
