<?php

namespace App\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\WebBundle\Form\NewsletterType;
use App\WebBundle\Form\ContactType;
use App\AdminBundle\Form\PartenaireType;
use App\WebBundle\Form\ClientType;
use App\CoreBundle\Entity\Contact;
use App\CoreBundle\Entity\Newsletter;
use App\CoreBundle\Entity\Partenaire;
use App\CoreBundle\Entity\Client;
use Symfony\Component\Security\Core\User\UserInterface;

use App\CoreBundle\Utils\Util;

use Symfony\Component\HttpFoundation\Request;

class ManagerController extends Controller
{
    /**
     * Lists all contact entities.
     *
     */
    public function indexAction(UserInterface $user = null, Request $request, $entity)
    {
        if(!is_null($user) && $user->hasRole('ROLE_CLIENT') && !$user->getClient()){
            $this->addFlash('warning', 'Veuillez continuez votre inscription s\'il vous plaît.');
            return $this->redirectToRoute('web_client_new');          
        }
        if(!is_null($user) && $user->hasRole('ROLE_PARTENAIRE') && !$user->getPartenaire()) {
            $this->addFlash('warning', 'Veuillez continuez votre inscription s\'il vous plaît.');

            return $this->redirectToRoute('web_partenaire_new');          
        }

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->findEntities();

        $paginates = $this->get('knp_paginator')->paginate(
                $entities, 
                $request->query->getInt('page', 1),
                4
            );

        return $this->render('WebBundle/Manager/index.html.twig', array(
            'entities' => $paginates,
            'entity' => $entity,
        ));
    }

    public function showAction(UserInterface $user = null, Request $request, $entity, $slug)
    {
        if(!is_null($user) && $user->hasRole('ROLE_CLIENT') && !$user->getClient()){
            $this->addFlash('warning', 'Veuillez continuez votre inscription s\'il vous plaît.');
            return $this->redirectToRoute('web_client_new');          
        }
        if(!is_null($user) && $user->hasRole('ROLE_PARTENAIRE') && !$user->getPartenaire()) {
            $this->addFlash('warning', 'Veuillez continuez votre inscription s\'il vous plaît.');

            return $this->redirectToRoute('web_partenaire_new');          
        }

        $em = $this->getDoctrine()->getManager();
        $obj = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->findEntityBySlug($slug);

        if(!$obj){
            return $this->createNotFoundException("L'entité n'existe pas.");
        }


        return $this->render('WebBundle/Manager/show.html.twig', ['obj' => $obj, 'entity' => $entity]);
    }

    public function newAction(UserInterface $user = null, Request $request, $entity) {
        if($entity !== 'contact' && $entity !== 'newsletter'){
           return $this->createNotFoundException("L'entité n'existe pas.");
       }
        $em = $this->getDoctrine()->getManager();

        $obj = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->create();

        $form = null;

        switch ($entity) {
            case 'contact':
                $form = $this->createForm(ContactType::class, $obj);
                break;
            case 'newsletter':
                $form = $this->createForm(NewsletterType::class, $obj);
                break;
        }

        if($form == null) {
            $this->addFlash('danger', 'Formulaire non trouvé.');
            return $this->redirectToRoute('admin_manage_index', ['entity' => $entity]);
        }

        if($request->isMethod('POST')) {

        $form->handleRequest($request);
        if($form->isSubmitted()) {
                if($form->isValid()) {
                    $obj->setToken(Util::tokenfy());
                    $obj->setChecked(0);

                    if($entity === 'contact' && $user){
                        $obj->setEmail($user->getEmail());
                    }
                    $em->persist($obj);
                    $em->flush();
                    $entity !== 'contact' 
                    ? $this->addFlash('info', 'Données du formulaire enregistrées avec succès.')
                    : $this->addFlash('info', 'Nous avons bien réçu votre message. On vous recontactera dans les plus bref delais.');
                    return $this->redirectToRoute('homepage');
                }else{
                    $this->addFlash('danger', 'Formulaire incorrect. Veuillez vérifier les champs.');
                }
            }
        }

        return $this->render('WebBundle/Manager/new.html.twig', [
            'form' => $form->createView(),
            'entity' => $entity,
        ]);

    }
}

