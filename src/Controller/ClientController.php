<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/registermee", name="registermeee")
     */
    public function register(): Response
    {

        return $this->render('register.html.twig');
    }
    /**
     * @Route("/basee", name="basee")
     */
    public function basee(): Response
    {

        return $this->render('base.html.twig');
    }
    /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {

        return $this->render('home.html.twig');
    }
    /**
     * @Route("/try", name="try")
     */
    public function tryme(): Response
    {

        return $this->render('bundles/registration/register_content.html.twig');
    }
    /**
     * @Route("/logg", name="logg")
     */
    public function logg(): Response
    {

        return $this->render('security/login.html.twig');
    }
}
