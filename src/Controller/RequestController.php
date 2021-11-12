<?php

namespace App\Controller;

use App\DTO\RequestDTO;
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
     * @Route("/add", name="add-request")
     */
    public function addRequestAction(Request $request): Response
    {
        $requestDTO = new RequestDTO();

        $form = $this->createForm(RequestForm::class, $requestDTO);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $request = RequestEntity::createFromDTO($requestDTO);
            $entityManager->persist($request);
            $entityManager->flush();
            $id = $request->getId();
            return $this->redirectToRoute("request view", ["id" => $id]);
        }

        return $this->renderForm('request/add_form.html.twig', [
            "form_add_request" => $form,
        ]);
    }
}