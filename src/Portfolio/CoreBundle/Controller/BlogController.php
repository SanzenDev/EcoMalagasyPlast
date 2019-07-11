<?php

namespace Portfolio\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PortfolioCoreBundle:Blog')->findEntities();

        $paginates = $this->get('knp_paginator')->paginate(
                $entities, 
                $request->query->getInt('page', 1),
                4
            );
        return $this->render('PortfolioCoreBundle/Blog/index.html.twig', array(
            'entities' => $paginates,
            'entity' => $entity,
        ));
    }

    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PortfolioCoreBundle:Blog')->findEntity($slug);

        if(!$entity)
            return $this->createNotFoundException("L'entité n'existe pas.");

        $tags = [];

        foreach (explode(',', $entity->getTags()) as $tag) {
            $tags[] = trim($tag);
        }

        return $this->render('PortfolioCoreBundle/Blog/show.html.twig', ['entity' => $entity,'tags' => $tags]);
    }
}

