<?php

namespace App\Controller\Admin;

use App\Entity\FicheProduit;
use App\Repository\FicheProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/fiche/produit")
 */
class AdminFicheProduitController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_fiche_produit_index", methods={"GET"})
     */
    public function index(FicheProduitRepository $ficheProduitRepository): Response
    {
        return $this->render('admin_fiche_produit/index.html.twig', [
            'fiche_produits' => $ficheProduitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_fiche_produit_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FicheProduitRepository $ficheProduitRepository): Response
    {
        $ficheProduit = new FicheProduit();
        $form = $this->createForm(FicheProduitType::class, $ficheProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheProduitRepository->add($ficheProduit, true);

            return $this->redirectToRoute('app_admin_fiche_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_fiche_produit/new.html.twig', [
            'fiche_produit' => $ficheProduit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_fiche_produit_show", methods={"GET"})
     */
    public function show(FicheProduit $ficheProduit): Response
    {
        return $this->render('admin_fiche_produit/show.html.twig', [
            'fiche_produit' => $ficheProduit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_fiche_produit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, FicheProduit $ficheProduit, FicheProduitRepository $ficheProduitRepository): Response
    {
        $form = $this->createForm(FicheProduitType::class, $ficheProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheProduitRepository->add($ficheProduit, true);

            return $this->redirectToRoute('app_admin_fiche_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_fiche_produit/edit.html.twig', [
            'fiche_produit' => $ficheProduit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_fiche_produit_delete", methods={"POST"})
     */
    public function delete(Request $request, FicheProduit $ficheProduit, FicheProduitRepository $ficheProduitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheProduit->getId(), $request->request->get('_token'))) {
            $ficheProduitRepository->remove($ficheProduit, true);
        }

        return $this->redirectToRoute('app_admin_fiche_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
