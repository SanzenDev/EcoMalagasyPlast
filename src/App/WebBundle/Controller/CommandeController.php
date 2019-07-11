<?php

namespace App\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\AdminBundle\Form\NewsType;
use App\AdminBundle\Form\PartenaireType;
use App\AdminBundle\Form\DechetType;
use App\AdminBundle\Form\PageType;
use App\CoreBundle\Entity\News;
use App\CoreBundle\Entity\Partenaire;
use App\CoreBundle\Entity\Dechet;
use App\CoreBundle\Entity\Page;
use App\CoreBundle\Entity\Commande;

use App\CoreBundle\Utils\Util;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{
    public function showAction($slug_dechet, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $dechet = $em->getRepository('AppCoreBundle:Dechet')->findOneBySlug($slug_dechet);
        $commande = $em->getRepository('AppCoreBundle:Commande')->findOneById($id);

        return $this->render('WebBundle/Commande/show.html.twig', ['commande' => $commande, 'dechet' => $dechet]);
    }

    public function commandeByUserAction(Request $request, $client_id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppCoreBundle:Commande')->findEntityByUser($client_id);


        return $this->render('WebBundle/Commande/index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function cancelAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('AppCoreBundle:Commande')->findOneById($id);
            
        if($commande->finished()){
            $this->addFlash('success', 'Votre commande est déjà expiré.');
            return $this->redirectToRoute('web_dechet_show', ['slug' => $dechet->getSlug() ]);          
        }

        $dechet = $commande->getDechet();

        $oldAmount = $dechet->getAmount() + $commande->getQuantity();
        $dechet->setAmount($oldAmount);

        $em->persist($dechet);
        $em->remove($commande);
        $em->flush();
        $this->addFlash('success', 'Votre commande a été annulé avec succès.');

        return $this->redirectToRoute('web_manage_index', ['entity' => 'dechet' ]);
    }


}

