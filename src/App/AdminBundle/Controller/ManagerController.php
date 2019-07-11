<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\AdminBundle\Form\UserType;
use App\AdminBundle\Form\NewsType;
use App\AdminBundle\Form\PartenaireType;
use App\AdminBundle\Form\DechetType;
use App\AdminBundle\Form\PageType;
use App\AdminBundle\Form\ClientType;
use App\CoreBundle\Events;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\CoreBundle\Utils\Util;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;

class ManagerController extends Controller
{
    /**
     * Lists all contact entities.
     *
     */
    public function indexAction(Request $request, $entity, $key = null)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->findEntities(strip_tags(trim($key)));

        $paginates = $this->get('knp_paginator')->paginate(
                $entities, 
                $request->query->getInt('page', 1),
                4
            );
        return $this->render('AdminBundle/Manager/index.html.twig', array(
            'entities' => $paginates,
            'entity' => $entity,
            'key' => $key,
        ));
    }

    public function updateAction(Request $request, $entity, $token, $slug) {

        $em = $this->getDoctrine()->getManager();

        $entityName = ucfirst($entity);
        $form = null;
        $obj = $em->getRepository('AppCoreBundle:'.$entityName)->findEntityBySlug($slug);

        switch ($entity) {
            case 'partenaire':
                $form = $this->createForm(PartenaireType::class, $obj);
                break;
            case 'utilisateur':
                $form = $this->createForm(UserType::class, $obj);
                break;
            case 'news':
                $form = $this->createForm(NewsType::class, $obj);
                break;
            case 'dechet':
                $form = $this->createForm(DechetType::class, $obj);
                break;
            case 'client':
                $form = $this->createForm(ClientType::class, $obj);
                break;
            case 'page':
                $form = $this->createForm(PageType::class, $obj);
                break;
        }

        if($form == null) {
            $this->addFlash('danger', 'Formulaire non trouvé.');
            return $this->redirectToRoute('admin_manage_index', ['entity' => $entity]);
        }

        if (!$obj) {
            throw $this->createNotFoundException('Unable to find Categories entity.');
        }
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isSubmitted()) {
                if($form->isValid()) {
                   $obj->setToken(Util::tokenfy());

                    $em->persist($obj);
                    $em->flush();
                    $this->addFlash('info', 'Données du formulaire '.$entityName.' enregistrées avec succès.');

                    if($entity === 'dechet'){
                        $eventDispatcher = $this->get('event_dispatcher');
                        $eventDispatcher->dispatch(Events::DECHET_ADDED, new GenericEvent($obj));
                    }

                    return $this->redirectToRoute('admin_manage_show', ['entity' => $entity, 'slug' => $obj->getSlug()]);
                }else{
                    $this->addFlash('danger', 'Formulaire incorrect. Veuillez vérifier les champs.');
                }
            }
        }

        return $this->render('AdminBundle/Manager/update.html.twig', [
            'form' => $form->createView(),
            'entity' => $entity,
            'obj' => $obj,
        ]);

    }
    public function newAction(UserInterface $user = null, Request $request, $entity) {

        $em = $this->getDoctrine()->getManager();

        $obj = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->create();

        $form = null;

        switch ($entity) {
            case 'utilisateur':
                $form = $this->createForm(UserType::class, $obj);
                break;
            case 'news':
                $form = $this->createForm(NewsType::class, $obj);
                break;
            case 'dechet':
                $form = $this->createForm(DechetType::class, $obj);
                break;
            case 'page':
                $form = $this->createForm(PageType::class, $obj);
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
                    if($entity !== 'dechet') {
                        $obj->setUser($user);
                    }
                    if($entity === 'partenaire') {
                        $obj->setChecked(1);
                    }
                    $em->persist($obj);
                    $em->flush();
                    $this->addFlash('info', ucfirst($entity).': "'. $obj->getSlug().'" enregistrées avec succès.');

                    if($entity === 'news'){
                        $eventDispatcher = $this->get('event_dispatcher');
                        $eventDispatcher->dispatch(Events::NEWS_CREATED, new GenericEvent($obj));
                    }
                    return $this->redirectToRoute('admin_manage_show', ['entity' => $entity, 'slug' => $obj->getSlug()]);
                }else{
                    $this->addFlash('danger', 'Formulaire incorrect. Veuillez vérifier les champs.');
                }
            }
        }

        return $this->render('AdminBundle/Manager/new.html.twig', [
            'form' => $form->createView(),
            'entity' => $entity,
        ]);

    }

    public function deleteAction(Request $request, $entity, $token)
    {
    	$type = $entity;
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppCoreBundle:'.ucfirst($type))->findOneByToken($token);

        if(!$entity){
            return $this->createNotFoundException("L'entité que vous recherchez à supprimer n'existe pas.");
        }

        $em->remove($entity);
        $em->flush();
        $this->addFlash('info', "Entité supprimé.");

        return $this->redirectToRoute('admin_dashboard');
    }

    public function showAction(Request $request, $entity, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        if($entity === 'contact'){
            $obj = $em->getRepository('AppCoreBundle:Contact')->findEntityByToken($token);          
        }
        $obj = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->findEntityBySlug($slug);

        if(!$obj)
            return $this->createNotFoundException("L'entité n'existe pas.");




        switch($entity) {
            case 'partenaire':
            case 'client':
            case 'commande':
            case 'utilisateur':
            case 'newsletter':
                $obj->setChecked(1);
                $em->persist($obj);
                $em->flush();
                $this->addFlash('info', ucfirst($entity)." marqué comme vue.");
                break;
        }

        return $this->render('AdminBundle/Manager/show.html.twig', ['obj' => $obj, 'entity' => $entity]);
    }


    public function checkAction($entity, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $obj = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->findOneBySlug($slug);

        if(!$obj)
            return $this->createNotFoundException("L'entité que vous recherchez à supprimer n'existe pas.");

        if($obj->getChecked() === false){
            $obj->setChecked(1);
            $em->persist($obj);
            $em->flush();
            $this->addFlash('info', "Marqué comme vu.");
        } else {
            $obj->setChecked(0);       
            $em->persist($obj);
            $em->flush();
            $this->addFlash('info', "Marqué comme non vu.");
        }

        return $this->redirectToRoute('admin_manage_show', ['entity' => $entity, 'slug' => $obj->getSlug()]);
    }

    public function publishAction($entity, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $obj = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->findEntityBySlug($slug);

        if(!$obj)
            return $this->createNotFoundException("L'entité que vous recherchez à supprimer n'existe pas.");

        if($obj->getEnabled() === false){
            $obj->setEnabled(1);
            $em->persist($obj);
            $em->flush();
            $this->addFlash('info', $obj->getSlug()." a été publié.");
        } else {
            $obj->setEnabled(0);          
            $em->persist($obj);
            $em->flush();

            $this->addFlash('info', $obj->getSlug()." n'est plus publié.");
        }

        return $this->redirectToRoute('admin_manage_show', ['entity' => $entity, 'slug' => $obj->getSlug()]);
    }

    public function filterAction(Request $request, $entity, $filter)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->findFilter($filter);
        $paginates = $this->get('knp_paginator')->paginate(
                $entities, 
                $request->query->getInt('page', 1),
                4
            );

        return $this->render('AdminBundle/Manager/index.html.twig', array(
            'entities' => $paginates,
            'entity' => $entity,
            'key' => null,
        ));
    }  

    public function filterAllAction(Request $request, $entity, $filter)
    {
        $em = $this->getDoctrine()->getManager();

        $em->getRepository('AppCoreBundle:'.ucfirst($entity))->filterAll($filter);

        $this->addFlash('info', "Tout est marqué comme lu.");

        $entities = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->findAll();

        $paginates = $this->get('knp_paginator')->paginate(
                $entities, 
                $request->query->getInt('page', 1),
                4
            );

        return $this->render('AdminBundle/Manager/index.html.twig', array(
            'entities' => $paginates,
            'entity' => $entity,
            'key' => null,
        ));
    }
}

