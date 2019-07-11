<?php

namespace App\CoreBundle\EventListener;

use App\CoreBundle\Entity\Newsletter;
use App\CoreBundle\Entity\News;
use App\CoreBundle\Events;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class NewsSubscriber implements EventSubscriberInterface
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
			Events::NEWS_CREATED => 'onNewsCreated'
		];
	}

	public function onNewsCreated(GenericEvent $event)
	{
		$news = $event->getSubject();

		$newsletters = $this->em->getRepository('AppCoreBundle:Newsletter')->findAll();

		foreach ($newsletters as $newsletter) {

			// if ($newsletter->getEmail() == $email) {
			// 	continue;
			// }
			$this->sendEmailNewsCreated($newsletter, $news);
		}
	}

	/**
	 * Notifies an user that comment has been added
	 * @param User $user            User that will receive notification
	 * @param NewsNews $comment Created comment
	 */
	protected function sendEmailNewsCreated(Newsletter $newsletter, News $news)
	{
		$subject =  sprintf('[Nouvelle actualité] : %s ',
			$news->getTitle()
		);

		$message = $this->templating->render('Emails/news_added.html.twig', [
			'entity' => $news
		]);

		$message = (new \Swift_Message($subject))
			->setFrom($this->sender)
			->setTo($newsletter->getEmail())
			->setBody($message, 'text/html');

		$this->mailer->send($message);
	}
}