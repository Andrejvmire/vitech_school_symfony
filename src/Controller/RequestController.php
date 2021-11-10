<?php

namespace App\Controller;

use App\Entity\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/request")
 */
class RequestController extends AbstractController
{
    /**
     * @Route("/", name="request list")
     */
    public function viewAction(): Response
    {
        $request_data = $this->getDoctrine()
            ->getRepository(Request::class)
            ->findAll();
        return $this->render('request/list.html.twig',
            [
                "request_data" => $request_data,
            ]);
    }

    /**
     * @Route("/{id}", name="request view")
     */
    public function requestViewAction(int $id): Response
    {
        $request_data = $this->getDoctrine()
            ->getRepository(Request::class)
            ->find($id);
        return $this->render('request/view.html.twig', [
            "request_data" => $request_data,
        ]);
    }
}