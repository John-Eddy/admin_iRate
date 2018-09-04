<?php

namespace App\Controller;

use App\Entity\Scans;
use App\Form\ScansType;
use App\Repository\ScansRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/scans")
 */
class ScansController extends AbstractController
{
    /**
     * @Route("/", name="scans_index", methods="GET")
     */
    public function index(ScansRepository $scansRepository): Response
    {
        return $this->render('scans/index.html.twig', ['scans' => $scansRepository->findAll()]);
    }

    /**
     * @Route("/new", name="scans_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $scan = new Scans();
        $form = $this->createForm(ScansType::class, $scan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($scan);
            $em->flush();

            return $this->redirectToRoute('scans_index');
        }

        return $this->render('scans/new.html.twig', [
            'scan' => $scan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="scans_show", methods="GET")
     */
    public function show(Scans $scan): Response
    {
        return $this->render('scans/show.html.twig', ['scan' => $scan]);
    }

    /**
     * @Route("/{id}/edit", name="scans_edit", methods="GET|POST")
     */
    public function edit(Request $request, Scans $scan): Response
    {
        $form = $this->createForm(ScansType::class, $scan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('scans_edit', ['id' => $scan->getId()]);
        }

        return $this->render('scans/edit.html.twig', [
            'scan' => $scan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="scans_delete", methods="DELETE")
     */
    public function delete(Request $request, Scans $scan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scan->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($scan);
            $em->flush();
        }

        return $this->redirectToRoute('scans_index');
    }
}
