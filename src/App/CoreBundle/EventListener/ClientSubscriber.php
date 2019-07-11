<?php

namespace App\CoreBundle\EventListener;

use App\CoreBundle\Entity\Client;
use App\CoreBundle\Events;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class ClientSubscriber implements EventSubscriberInterface
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
			Events::CLIENT_ADDED => 'onClientAdded'
		];
	}

	public function onClientAdded(GenericEvent $event)
	{
			$client = $event->getSubject();

			$this->sendEmailClientAdded($client);
	}

	/**
	 * Notifies an user that comment has been added
	 * @param User $user            User that will receive notification
	 * @param ClientClient $comment Added comment
	 */
	protected function sendEmailClientAdded(Client $client)
	{
		$subject =  sprintf('[Nouveau Client] %s ajouté',
			$client->getName()
		);

		$message = $this->templating->render('Emails/client_added.html.twig', [
			'entity' => $client
		]);

		$message = (new \Swift_Message($subject))
			->setFrom($client->getUser()->getEmail())
			->setTo($this->receiver)
			->setBody($message, 'text/html');

		$this->mailer->send($message);
	}
}