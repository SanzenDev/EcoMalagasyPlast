<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\CoreBundle\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
     public function setAdminAction($token)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppCoreBundle:Utilisateur')->findOneByToken($token);

        if(!$user->isSuperAdmin()){
            $user->setAdmin(true);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', $user->getUsername." a été fait comme adminsitrateur du site.");
            
            return $this->redirectToRoute('admin_manage_show', ['entity' => 'user', 'slug' => $user->getUsername()]);

        } else {
            $user->setAdmin(false);
            $em->persist($entity);
            $em->flush();

            $this->addFlash('success', $user->getUsername." n'est plus adminsitrateur du site.");
                return $this->redirectToRoute('admin_manage_show', ['entity' => 'user', 'slug' => $user->getUsername()]);

        }

    }
}

