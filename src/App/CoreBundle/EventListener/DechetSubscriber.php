<?php

namespace App\CoreBundle\EventListener;

use App\CoreBundle\Entity\Newsletter;
use App\CoreBundle\Entity\Dechet;
use App\CoreBundle\Events;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class DechetSubscriber implements EventSubscriberInterface
{
	private $mailer;
	private $em;
	private $templating;
	private $sender;

	public function __construct(\Swift_Mailer $mailer, EntityManager $em, TwigEngine $templating, $sender)
	{
		$this->mailer = $mailer;
		$this->em = $em;
		$this->templating = $templating;
		$this->sender = $sender;
	}

	public static function getSubscribedEvents()
	{
		return [
			Events::DECHET_ADDED => 'onDechetAdded'
		];
	}

	public function onDechetAdded(GenericEvent $event)
	{
		$dechet = $event->getSubject();

		$newsletters = $this->em->getRepository('AppCoreBundle:Newsletter')->findAll();

		foreach ($newsletters as $newsletter) {

			// if ($newsletter->getEmail() == $email) {
			// 	continue;
			// }
			$this->sendEmailDechetAdded($newsletter, $dechet);
		}
	}

	/**
	 * Notifies an user that comment has been added
	 * @param User $user            User that will receive notification
	 * @param DechetDechet $comment Added comment
	 */
	protected function sendEmailDechetAdded(Newsletter $newsletter, Dechet $dechet)
	{
		$subject =  sprintf('[Dechet] %s ajouté',
			$dechet->getName()
		);

		$message = $this->templating->render('Emails/dechet_added.html.twig', [
			'dechet' => $dechet
		]);

		$message = (new \Swift_Message($subject))
			->setFrom($this->sender)
			->setTo($newsletter->getEmail())
			->setBody($message, 'text/html');

		$this->mailer->send($message);
	}
}