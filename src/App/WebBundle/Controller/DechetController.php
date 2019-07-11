<?php

namespace App\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\WebBundle\Form\CommandeType;
use App\CoreBundle\Entity\Commande;
use Symfony\Component\Security\Core\User\UserInterface;
use \DateTime;
use App\CoreBundle\Utils\Util;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\EventDispatcher\GenericEvent;
use App\CoreBundle\Events;

class DechetController extends Controller
{
    public function showAction(UserInterface $user = null, Request $request, $slug) {
        $em = $this->getDoctrine()->getManager();
        $dechet = $em->getRepository('AppCoreBundle:Dechet')->findEntityBySlug($slug);

        $commande = new Commande;

        $form = $this->createForm(CommandeType::class, $commande);
        // $formData = $form->getData();

        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isSubmitted()) {
                if($form->isValid()) {
                    if($dechet->getAmount() >= $commande->getQuantity() ) {
                        $commande->setToken(Util::tokenfy());
                        $commande->setChecked(0);
                        $commande->setEnabled(1);
                        $commande->setClient($user->getClient());

                        $quantity = $commande->getQuantity();
                        $newAmount = $dechet->getAmount() - $quantity; 

                        $dechet->setAmount($newAmount);
                        $now = new DateTime(date('d-m-Y'));
                        // $nowStr = new DateTime($now->format('d-m-Y'));
                        $commande->setDelais($now->modify('+7 day'));
                        // $commande->setDelais(new DateTime("now +7 day"));
                        $commande->setDechet($dechet);

                        // $em->persist($dechet);
                        $em->persist($commande);
                        $em->flush();
                        $this->addFlash('info', 'Vous avez commandé '.$quantity.' kg de '.$dechet->getName().'. On vous contactera bientôt. Cordialement, l\'equipe de Re-cycl\in Mada.');

                    $eventDispatcher = $this->get('event_dispatcher');
                    $eventDispatcher->dispatch(Events::COMMANDE_ADDED, new GenericEvent($commande));

                        return $this->redirectToRoute('web_commande_show', ['id' => $commande->getId(),'slug_dechet' => $dechet->getSlug() ]);
                    } else {
                        $this->addFlash('warning', 'Il n\'y a pas assez de déchet pour votre demande.');
                            return $this->redirectToRoute('web_dechet_show', ['slug' => $dechet->getSlug() ]);
                    }
                } else {
                        $this->addFlash('danger', 'Formulaire incorrect. Veuillez vérifier les champs.');
                }
            }
        }

        return $this->render('WebBundle/Manager/show.html.twig', [
            'form' => $form->createView(),
            'commande' => $commande,
            'entity' => 'dechet',
            'obj' => $dechet,
        ]);

    }
}

