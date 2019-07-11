<?php

namespace App\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\WebBundle\Form\ClientType;
use App\CoreBundle\Entity\Client;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\CoreBundle\Events;

use App\CoreBundle\Utils\Util;

use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    public function newAction(UserInterface $user = null, Request $request) {
        if(!is_null($user) && !$this->get('security.authorization_checker')->isGranted('ROLE_CLIENT')){
            return $this->redirectToRoute('fos_user_security_login');          
        }
        if(is_null($user)){
            return $this->redirectToRoute('fos_user_registration_register');          
        }
        if(!is_null($user) && $user->hasRole('ROLE_CLIENT') && $user->getClient()){
            return $this->redirectToRoute('fos_user_profile_show');          
        }

        $em = $this->getDoctrine()->getManager();

        $obj = new Client;
        $form = $this->createForm(ClientType::class, $obj);

        if($request->isMethod('POST')) {

            $form->handleRequest($request);
            if($form->isSubmitted()) {
                if($form->isValid()) {
                    $obj->setToken(Util::tokenfy());
                    $obj->setChecked(0);
                    $obj->setEnabled(1);
                    $obj->setUser($user);

                    $em->persist($obj);
                    $em->flush();
                    $this->addFlash('info', 'Votre compte est desormais actif. Vous pouvez desormais commander les dechets disponisble sur le site.');

                    $eventDispatcher = $this->get('event_dispatcher');
                    $eventDispatcher->dispatch(Events::CLIENT_ADDED, new GenericEvent($obj));

                    return $this->redirectToRoute('homepage');
                }else{
                    $this->addFlash('danger', 'Formulaire incorrect. Veuillez vérifier les champs.');
                }
            }
        }

        return $this->render('WebBundle/Manager/new.html.twig', [
            'form' => $form->createView(),
            'entity' => 'client',
        ]);
    }
    public function updateAction(UserInterface $user = null, Request $request, $slug) {
        if(is_null($user) && !$this->get('security.authorization_checker')->isGranted('ROLE_CLIENT')){
            return $this->redirectToRoute('fos_user_security_login');          
        }
        $em = $this->getDoctrine()->getManager();

        $obj = $em->getRepository('AppCoreBundle:Client')->findOneBySlug($slug);
        $form = $this->createForm(ClientType::class, $obj);

        if($user === $obj){
            if($request->isMethod('POST')) {

                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    if($form->isValid()) {
                        $obj->setChecked(0);
                        $obj->setUser($user);

                        $em->persist($obj);
                        $em->flush();
                        $this->addFlash('info', 'Votre commande a été modifié avec succès.');
                        return $this->redirectToRoute('app_web_homepage');
                    } else {
                        $this->addFlash('danger', 'Formulaire incorrect. Veuillez vérifier les champs.');
                    }
                }
                return $this->render('WebBundle/Manager/new.html.twig', [
                    'form' => $form->createView(),
                    'entity' => 'partenaire',
                ]);
            }
        }
    }
}

