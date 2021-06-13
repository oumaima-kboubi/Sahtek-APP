<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockManagerController extends AbstractController
{
    /**
     * @Route("/stockmanager/{id}", name="stock_manager")
     */
    public function index(): Response
    {
        return $this->render('stock_manager/index.html.twig', [
            'controller_name' => 'StockManagerController',
        ]);
    }
}
