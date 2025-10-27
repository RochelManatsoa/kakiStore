<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticPageController extends AbstractController
{
    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('static/faq.html.twig');
    }

    #[Route('/conditions-utilisation', name: 'app_terms')]
    public function terms(): Response
    {
        return $this->render('static/terms.html.twig');
    }

    #[Route('/confidentialite', name: 'app_privacy')]
    public function privacy(): Response
    {
        return $this->render('static/privacy.html.twig');
    }

    #[Route('/livraison-expedition', name: 'app_delivery')]
    public function delivery(): Response
    {
        return $this->render('static/delivery.html.twig');
    }

    #[Route('/politique-de-retour', name: 'app_returns')]
    public function returns(): Response
    {
        return $this->render('static/returns.html.twig');
    }
}
