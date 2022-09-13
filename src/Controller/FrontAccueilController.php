<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontAccueilController extends AbstractController
{
    /**
     * @Route("/", name="app_front_accueil")
     */
    public function index(ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
    {
        $produits = $produitRepository->findAll();
        $categories = $categorieRepository->findAll();
        $produitIsNew = $produitRepository->findByIsNew(1);
// dd($produits);
        return $this->render('front_accueil/index.html.twig', [
            'produits' => $produits,
            'categories' => $categories,
            'produitIsNew'=> $produitIsNew
        ]);
    }

/**
     * @Route("/produit/{slug}", name="app_produit_detail")
     */
    public function show(?Produit $produit): Response {
        if(!$produit){
            return $this->redirectToRoute('app_front_accueil');
        }

        return $this->render("front_accueil/single-produit.html.twig",[
            'produit'=>$produit
        ]);

    }

}
