<?php

namespace App\CoreBundle\EventListener;

use App\CoreBundle\Entity\Contact;
use App\CoreBundle\Events;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class ContactSubscriber implements EventSubscriberInterface
{
	private $mailer;
	private $templating;
	private $sender;

	public function __construct(\Swift_Mailer $mailer, TwigEngine $templating, $sender)
	{
		$this->mailer = $mailer;
		$this->templating = $templating;
		$this->sender = $sender;
	}

	public static function getSubscribedEvents()
	{
		return [
			Events::CONTACT_CREATED => 'onContactCreated'
		];
	}

	public function onContactCreated(GenericEvent $event)
	{
		$contact = $event->getSubject();

		if (!$contact instanceof Contact)
			return;

		$this->sendEmailContactCreated($contact);
	}

	/**
	 * Notifies an user that contact has been added
	 * @param User $user            User that will receive notification
	 * @param TopicComment $contact Added contact
	 */
	protected function sendEmailContactCreated(Contact $contact)
	{
		$subject =  sprintf('[NOUVEAU MESSAGE] %s %s',
			$contact->getSubject()
		);

		$message = $this->templating->render('Emails/contact.html.twig', [
			'entity' => $contact
		]);

		$message = \Swift_Message::newInstance()
	        ->setSubject($subject)
			->setFrom($this->sender)
			->setTo($contact->getEmail())
			->setBody($message)
	        ->setContentType("text/html");

		$this->mailer->send($message);
	}
}