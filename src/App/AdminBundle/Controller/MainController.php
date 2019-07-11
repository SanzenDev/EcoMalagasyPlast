<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $newsRepository = $this->get('app.repository.news');
        $partenaireRepository = $this->get('app.repository.partenaire');
        $clientRepository = $this->get('app.repository.client');
        $commandeRepository = $this->get('app.repository.commande');
        $dechetRepository = $this->get('app.repository.dechet');
        $pageRepository = $this->get('app.repository.page');
        $contactRepository = $this->get('app.repository.contact');
        $newsletterRepository = $this->get('app.repository.newsletter');
        $utilisateurRepository = $this->get('app.repository.utilisateur');

        return $this->render('AdminBundle/home.html.twig', [
            'news_count' => $newsRepository->countAll(),
            'dechet_count' => $dechetRepository->countAll(),
            'commande_count' => $commandeRepository->countAll(),
            'partenaire_count' => $partenaireRepository->countAll(),
            'client_count' => $clientRepository->countAll(),
            'utilisateur_count' => $utilisateurRepository->countAll(),
            'contact_count' => $contactRepository->countAll(),
            'newsletter_count' => $newsletterRepository->countAll(),
            'page_count' => $pageRepository->countAll(),
        ]);
    }

    public function notificationAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partenaires = $this->get('app.repository.partenaire')->countUnchecked();
        $contacts = $this->get('app.repository.contact')->countUnchecked();
        $newsletters = $this->get('app.repository.newsletter')->countUnchecked();
        $clients = $this->get('app.repository.client')->countUnchecked();
        $commandes = $this->get('app.repository.commande')->countUnchecked();

        $total = $partenaires + $contacts + $newsletters + $clients + $commandes;

        return $this->render('AdminBundle/Common/notification.html.twig', array(
            'count_partenaires' => $partenaires,
            'count_contacts' => $contacts,
            'count_newsletters' => $newsletters,
            'count_clients' => $clients,
            'count_commandes' => $commandes,
            'count_total' => $total
        ));
    }

    public function printAction($entity, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $print = $em->getRepository('AppCoreBundle:'.ucfirst($entity))->findOneById($id);
        
        if (!$print) {
            $this->addFlash('warning', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('admin_dashboard'));
        }
        
        return $this->render('AdminBundle/Common/print.html.twig', array(
            'obj' => $print,
            'entity' => $entity,
        ));
    }
}
