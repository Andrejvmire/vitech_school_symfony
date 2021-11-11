<?php

namespace App\Controller;

use App\Entity\Request as RequestEntity;
use App\Form\RequestForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            ->getRepository(RequestEntity::class)
            ->findAll();
        return $this->render('request/list.html.twig',
            [
                "request_data" => $request_data,
            ]);
    }

    /**
     * @Route("/{id<\d+>}", name="request view")
     */
    public function requestViewAction(int $id): Response
    {
        $request_data = $this->getDoctrine()
            ->getRepository(RequestEntity::class)
            ->find($id);
        return $this->render('request/view.html.twig', [
            "request_data" => $request_data,
        ]);
    }

    /**
     * @Route("/add", name="add-request", )
     */
    public function addRequestAction(Request $request): Response
    {
        $request_data = new RequestEntity("3", "3");

        $form = $this->createForm(RequestForm::class, $request_data);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $request_data = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($request_data);
            $entityManager->flush();
            $id = $request_data->getId();
            return $this->redirectToRoute("request view", ["id" => $id]);
        }

        return $this->renderForm('request/add_form.html.twig', [
            "form_add_request" => $form,
        ]);
    }
}