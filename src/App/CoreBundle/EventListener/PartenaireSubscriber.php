<?php

namespace App\CoreBundle\EventListener;

use App\CoreBundle\Entity\Partenaire;
use App\CoreBundle\Events;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class PartenaireSubscriber implements EventSubscriberInterface
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
			Events::PARTENAIRE_ADDED => 'onPartenaireAdded'
		];
	}

	public function onPartenaireAdded(GenericEvent $event)
	{
			$partenaire = $event->getSubject();

			$this->sendEmailPartenaireAdded($partenaire);
	}

	/**
	 * Notifies an user that comment has been added
	 * @param User $user            User that will receive notification
	 * @param Partenaire $comment Added comment
	 */
	protected function sendEmailPartenaireAdded(Partenaire $partenaire)
	{
		$subject =  sprintf('[Nouveau Partenaire] %s ajouté',
			$partenaire->getName()
		);

		$message = $this->templating->render('Emails/partenaire_added.html.twig', [
			'entity' => $partenaire
		]);

		$message = (new \Swift_Message($subject))
			->setFrom($partenaire->getUser()->getEmail())
			->setTo($this->receiver)
			->setBody($message, 'text/html');

		$this->mailer->send($message);
	}
}