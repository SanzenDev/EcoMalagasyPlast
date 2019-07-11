<?php

namespace Portfolio\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Portfolio\CoreBundle\Form\CvType;
use Portfolio\CoreBundle\Form\AboutType;
use Portfolio\CoreBundle\Form\BlogType;
use Portfolio\CoreBundle\Form\ExperienceType;
use Portfolio\CoreBundle\Entity\Contact;
use Portfolio\CoreBundle\Events;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\CoreBundle\Utils\Util;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction(Request $request, $entity)
    {
        $entity = strip_tags(trim($entity));
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PortfolioCoreBundle:'.ucfirst($entity))->findEntities();

        $paginates = $this->get('knp_paginator')->paginate(
                $entities, 
                $request->query->getInt('page', 1),
                4
            );
        return $this->render('PortfolioCoreBundle/Admin/index.html.twig', array(
            'entities' => $paginates,
            'entity' => $entity,
        ));
    }


    public function updateAction(Request $request, $entity, $token) {

        $em = $this->getDoctrine()->getManager();
        $entityName = strip_tags(trim((ucfirst($entity))));
        $form = null;
        $obj = $em->getRepository('PortfolioCoreBundle:'.$entityName)->findOneByToken($token);

        switch ($entity) {
            case 'about':
                $form = $this->createForm(AboutType::class, $obj);
                break;
            case 'blog':
                $form = $this->createForm(BlogType::class, $obj);
                break;
            case 'experience':
                $form = $this->createForm(ExperienceType::class, $obj);
                break;
            case 'cv':
                $form = $this->createForm(CvType::class, $obj);
                break;
        }

        if (!$obj) {
            throw $this->createNotFoundException('Unable to find entity.');
        }
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isValid() && $form->isSubmitted()) {
               $obj->setToken(Util::tokenfy());

                $em->persist($obj);
                $em->flush();
                $this->addFlash('info', 'Données du formulaire '.$entityName.' enregistrées avec succès.');

                return $this->redirectToRoute('ps_home');
            }
        }

        return $this->render('PortfolioCoreBundle/Admin/form.html.twig', [
            'form' => $form->createView(),
            'entity' => $entity,
            'obj' => $obj,
        ]);

    }
    public function newAction(Request $request, $entity) {
        $entity = strip_tags(trim($entity));
        $em = $this->getDoctrine()->getManager();

        $obj = $em->getRepository('PortfolioCoreBundle:'.ucfirst($entity))->create();

        $form = null;

        switch ($entity) {
            case 'about':
                $form = $this->createForm(AboutType::class, $obj);
                break;
            case 'blog':
                $form = $this->createForm(BlogType::class, $obj);
                break;
            case 'experience':
                $form = $this->createForm(ExperienceType::class, $obj);
                break;
            case 'cv':
                $form = $this->createForm(CvType::class, $obj);
                break;
        }

        if($form == null) {
            $this->addFlash('danger', 'Formulaire non trouvé.');
            return $this->redirectToRoute('admin_manage_index', ['entity' => $entity]);
        }
        if($request->isMethod('POST')) {

            $form->handleRequest($request);
            if($form->isValid() && $form->isSubmitted()) {
                
               $obj->setToken(Util::tokenfy());
                $em->persist($obj);
                $em->flush();
                $this->addFlash('info', ucfirst($entity).' enregistrées avec succès.');

                return $this->redirectToRoute('ps_home');
            }
        }

        return $this->render('PortfolioCoreBundle/Admin/form.html.twig', [
            'form' => $form->createView(),
            'entity' => $entity,
        ]);

    }

    public function deleteAction(Request $request, $entity, $token)
    {
        $type = strip_tags(trim($entity));
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PortfolioCoreBundle:'.ucfirst($type))->findOneByToken($token);

        if(!$entity){
            return $this->createNotFoundException("L'entité que vous recherchez à supprimer n'existe pas.");
        }

        $em->remove($entity);
        $em->flush();
        $this->addFlash('info', "Entité supprimé.");

        return $this->redirectToRoute('ps_home');
    }
}

