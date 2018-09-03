<?php

namespace App\Controller;

use App\Entity\Items;
use App\Form\ItemsType;
use App\Repository\ItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/items")
 */
class ItemsController extends AbstractController
{
    /**
     * @Route("/", name="items_index", methods="GET")
     */
    public function index(ItemsRepository $itemsRepository): Response
    {
        return $this->render('items/index.html.twig', ['items' => $itemsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="items_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $item = new Items();
        $form = $this->createForm(ItemsType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('items_index');
        }

        return $this->render('items/new.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="items_show", methods="GET")
     */
    public function show(Items $item): Response
    {
        return $this->render('items/show.html.twig', ['item' => $item]);
    }

    /**
     * @Route("/{id}/edit", name="items_edit", methods="GET|POST")
     */
    public function edit(Request $request, Items $item): Response
    {
        $form = $this->createForm(ItemsType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('items_edit', ['id' => $item->getId()]);
        }

        return $this->render('items/edit.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="items_delete", methods="DELETE")
     */
    public function delete(Request $request, Items $item): Response
    {
        if ($this->isCsrfTokenValid('delete'.$item->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush();
        }

        return $this->redirectToRoute('items_index');
    }
}
