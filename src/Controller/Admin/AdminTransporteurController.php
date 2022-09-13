<?php

namespace App\Controller\Admin;

use App\Entity\Transporteur;
use App\Form\TransporteurType;
use App\Repository\TransporteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/transporteur")
 */
class AdminTransporteurController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_transporteur_index", methods={"GET"})
     */
    public function index(TransporteurRepository $transporteurRepository): Response
    {
        return $this->render('admin_transporteur/index.html.twig', [
            'transporteurs' => $transporteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_transporteur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TransporteurRepository $transporteurRepository): Response
    {
        $transporteur = new Transporteur();
        $form = $this->createForm(TransporteurType::class, $transporteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transporteurRepository->add($transporteur, true);

            return $this->redirectToRoute('app_admin_transporteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_transporteur/new.html.twig', [
            'transporteur' => $transporteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_transporteur_show", methods={"GET"})
     */
    public function show(Transporteur $transporteur): Response
    {
        return $this->render('admin_transporteur/show.html.twig', [
            'transporteur' => $transporteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_transporteur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Transporteur $transporteur, TransporteurRepository $transporteurRepository): Response
    {
        $form = $this->createForm(TransporteurType::class, $transporteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transporteurRepository->add($transporteur, true);

            return $this->redirectToRoute('app_admin_transporteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_transporteur/edit.html.twig', [
            'transporteur' => $transporteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_transporteur_delete", methods={"POST"})
     */
    public function delete(Request $request, Transporteur $transporteur, TransporteurRepository $transporteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transporteur->getId(), $request->request->get('_token'))) {
            $transporteurRepository->remove($transporteur, true);
        }

        return $this->redirectToRoute('app_admin_transporteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
