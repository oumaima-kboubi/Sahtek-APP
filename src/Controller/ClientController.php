<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $client = $repository->findAll();
        return $this->render('client/index.html.twig',$client);
    }
    //jjd d jnjkzjd jsqkndjsnd
}
