<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="defaul page");
     *
     */
    public function indexAction(): Response
    {
        return new Response("Привет мир!");
    }

    /**
     * @Route("/show_name/{name}", name="show-name-page");
     *
     */
    public function showNameAction(string $name): Response
    {
        $random_int = random_int(0, 100);
        return $this->render('order/show.html.twig', [
            "name" => $name,
            "number" => $random_int,
        ]);
    }
}