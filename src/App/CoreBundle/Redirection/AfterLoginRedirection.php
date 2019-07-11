<?php
namespace App\CoreBundle\Redirection;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * Class AfterLoginRedirection
 *
 * @package App\CoreBundle\Redirection
 */
class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
	private $router ;
	/**
	* AfterLoginRedirectionnconstructor.
	*
	* @param RouterInterface $router
	 */
	public function __construct (RouterInterface $router )
	{
		$this->router = $router ;
	}
	/**
	* @param Request $request
	*
	* @param TokenInterface $token
	*
	* @return RedirectResponse
	*/
	// onLogoutSuccess()
	public function onAuthenticationSuccess(Request $request, TokenInterface $token )
	{

        if(!empty($token->getUser())){

            if($token->getUser()->hasRole('ROLE_PARTENAIRE') && !$token->getUser()->getPartenaire()->getEnabled()) {
            	    $this->container->get('session')->getFlashBag()->add('info', 'Votre compte partenaire est supprimé.');
					$redirection = new RedirectResponse($this->router->generate('web_manage_new', ['entity'=>'partenaire']));   
 
            } else if ($token->getUser()->hasRole('ROLE_CLIENT') && !$token->getUser()->getClient()->getEnabled()) {
            	    $this->container->get('session')->getFlashBag()->add('info', 'Votre compte client est supprimé.');
					$redirection = new RedirectResponse($this->router->generate('web_manage_new', ['entity'=>'client']));   

            }

        }

        if($token->getUser()->hasRole('ROLE_ADMIN') || $token->getUser()->hasRole('ROLE_SUPER_ADMIN')){
			$redirection = new RedirectResponse($this->router->generate('admin_dashboard'));

        } 
        if($token->getUser()->hasRole('ROLE_CLIENT') || $token->getUser()->hasRole('ROLE_PARTENAIRE')) {
			$redirection = new RedirectResponse($this->router->generate('fos_user_profile_show'));   
        }

		return $redirection ;
	}
}