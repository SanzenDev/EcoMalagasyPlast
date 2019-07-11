<?php

namespace App\CoreBundle\EventListener;

use App\CoreBundle\Entity\Commande;
use App\CoreBundle\Events;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class CommandeSubscriber implements EventSubscriberInterface
{
	private $mailer;
	private $templating;
	private $receiver;

	public function __construct(\Swift_Mailer $mailer, TwigEngine $templating, $receiver)
	{
		$this->mailer = $mailer;
		$this->templating = $templating;
		$this->receiver = $receiver;
	}

	public static function getSubscribedEvents()
	{
		return [
			Events::COMMANDE_ADDED => 'onCommandeCreated'
		];
	}

	public function onCommandeCreated(GenericEvent $event)
	{
		$commande = $event->getSubject();

		if (!$commande instanceof Commande)
			return;

		$this->sendEmailCommandeCreated($commande);
	}

	/**
	 * Notifies an user that comment has been added
	 * @param User $user            User that will receive notification
	 * @param CommandeCommande $comment Created comment
	 */
	protected function sendEmailCommandeCreated(Commande $commande)
	{
		$subject =  sprintf('[Nouvelle Commande] de %s ',
			$commande->getClient()->getName()
		);

		$message = $this->templating->render('Emails/commande_added.html.twig', [
			'commande' => $commande
		]);

		$message = (new \Swift_Message($subject))
			->setFrom($commande->getClient()->getUser()->getEmail())
			->setTo($this->receiver)
			->setBody($message, 'text/html');

		$this->mailer->send($message);
	}
}