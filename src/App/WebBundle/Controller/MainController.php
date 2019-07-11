<?php

namespace App\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function homeAction()
    {
        return $this->render('WebBundle/home.html.twig', [
            'news' => $this->get('app.repository.news')->findLatest(4),
            'dechets' => $this->get('app.repository.dechet')->findLatest(8),
            // 'partenaires' => $this->get('app.repository.partenaire')->findLatest(3),
       ]);
    }

    public function asideAction()
    {
        return $this->render('WebBundle/Common/aside.html.twig', [
            'aside_news' => $this->get('app.repository.news')->findList(8),
            'aside_dechets' => $this->get('app.repository.dechet')->findLatest(8),
            'aside_partenaires' => $this->get('app.repository.partenaire')->findList(4),
       ]);
    }

    public function sitemapAction()
    {
        return $this->render('WebBundle/Common/sitemap.html.twig', [
            'news' => $this->get('app.repository.news')->findLatest(6),
            'dechets' => $this->get('app.repository.dechet')->findLatest(6),
            'partenaires' => $this->get('app.repository.partenaire')->findList(4),
            'pages' => $this->get('app.repository.partenaire')->findList(10),
        ]);
    }

    public function fluxAction()
    {
        $entities = $this->get('app.repository.dechet')->findLatest();

        $latestPost = $this->get('app.repository.dechet')->getLatestPost();
 
        if($latestPost) {
            $lastUpdated = $latestPost->getCreatedAt()->format(DATE_ATOM);
        } else {
            $lastUpdated = new \DateTime();
            $lastUpdated = $lastUpdated->format(DATE_ATOM);
        }
        return $this->render('WebBundle/Common/flux.atom.twig', [
            'entities' => $entities,
            'lastUpdated' => $lastUpdated,
            'feedId' => sha1($this->get('router')->generate('web_manage_index', ['entity'=> 'dechet'], true)),
        ]);
    }

    public function searchAction(Request $request, $key)
    {

        $entities = $this->get('app.repository.dechet')->search(strip_tags(trim($key)));

        $paginates = $this->get('knp_paginator')->paginate(
                $entities, 
                $request->query->getInt('page', 1),
                4
            );
          return $this->render('WebBundle/Manager/index.html.twig', array(
            'entities' => $paginates,
            'entity' => 'dechet',
        ));
    }
}
