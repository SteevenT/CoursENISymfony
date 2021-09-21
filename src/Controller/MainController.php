<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home_front")
     */
    public function homeFront(): Response
    {
        die('Hello World');
        /* return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]); */
    }
    
    /**
     * @Route("/test/demo", name="demo")
     */
    public function demoRoute(): Response
    {
        $tab['message'] = 'hello';

        return $this->json($tab);
    }

    /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {
        $tab['message'] = 'Bienvenue';

        return $this->json($tab);
    }

    /**
     * @Route("/about_us", name="about")
     */
    public function about(): Response
    {
        $tab[0] = 'TILLIER Steeven';
        $tab[1] = 'HAMON Pierre';
        $tab[2] = 'TORRES Guillaume';
        $tab[3] = 'ANTOINE Marc';
        $tab[4] = 'POUTOU Philipe';

        return $this->render('main/about.html.twig',['tab' => $tab]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contacts(): Response
    {
        $tab['message'] = 'Formulaire de contact';

        return $this->json($tab);
    }
}
