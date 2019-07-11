<?php

namespace Portfolio\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Portfolio\CoreBundle\Form\ContactType;
use Portfolio\CoreBundle\Form\AboutType;
use Portfolio\CoreBundle\Form\BlogType;
use Portfolio\CoreBundle\Form\ExperienceType;
use Portfolio\CoreBundle\Entity\Contact;
use Portfolio\CoreBundle\Events;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\CoreBundle\Utils\Util;
use Symfony\Component\HttpFoundation\Request;

class ManagerController extends Controller
{
    public function homeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $blogs = $em->getRepository('PortfolioCoreBundle:Blog')->findLatest(4);
        $about = $em->getRepository('PortfolioCoreBundle:About')->findAbout();
        $cv = $em->getRepository('PortfolioCoreBundle:Cv')->findCv();
        $experiences = $em->getRepository('PortfolioCoreBundle:Experience')->findEntities();
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        if($request->isMethod('POST')) {

            $form->handleRequest($request);
            if($form->isValid() && $form->isSubmitted()) {
               $contact->setToken(Util::tokenfy());
                $em->persist($contact);
                $em->flush();

                $subject =  sprintf('[Nouveau Message] de %s ',
                    $contact->getName()
                );

                $message = $this->render('PortfolioCoreBundle/email.html.twig', [
                    'entity' => $contact
                ]);

                $message = (new \Swift_Message($subject))
                    ->setFrom($contact->getEmail())
                    ->setTo('ralainirinatiavina@gmail.com')
                    ->setBody($message, 'text/html');

                $this->get('mailer')->send($message);

                $this->addFlash('info', 'Votre message a été envoyé avec succès. On vous recontactera bientôt. Cordialement, Tiavina.');

                return $this->redirectToRoute('ps_home');
            }
        }

        return $this->render('PortfolioCoreBundle/portfolio.html.twig', array(
            'blogs' => $blogs,
            'experiences' => $experiences,
            'about' => $about,
            'cv' => $cv,
            'form' => $form->createView(),
        ));
    }
}

