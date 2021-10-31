<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/", name="defaul page");
     *
     */
    public function indexAction(): Response
    {
        return new Response("Привет мир!");
    }
}