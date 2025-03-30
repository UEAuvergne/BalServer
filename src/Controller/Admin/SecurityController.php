<?php
namespace App\Controller\Admin;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use function PHPUnit\Framework\throwException;

class SecurityController extends AbstractController
{
    #[Route("/admin/login", name: "admin_login")]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@EasyAdmin/page/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,

            'csrf_token_intention' => "Token"
        ]);
    }
    
    #[Route("/logout", name: "logout")]
    public function logout()
    {
        return new Exception("Logout will be caught by the firewall");
    }
}

