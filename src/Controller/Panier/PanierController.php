<?php

namespace App\Controller\Panier;

use App\Entity\Produit;
use App\Services\PanierServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    private $panierServices;

    public function __construct(PanierServices $panierServices)
    {
        $this->panierServices = $panierServices;
    }


    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(): Response
    {
        
        $panier = $this->panierServices->allItemsPanier();
        if(!isset($panier['produits'])){
            return $this->redirectToRoute('app_front_accueil');
        }
        return $this->render('panier/index.html.twig', [
            'panier'=>$panier,

        ]);
    }

// ====================================================== //
// ============ //ajouter 1 produit au panier =========== //
// ====================================================== //
    /**
     * @Route("/panier/ajout/{id}", name="app_panier_ajout")
     */
    public function addPanier($id) : Response
    {   
        $this->panierServices->addPanier($id);
        return $this->redirectToRoute('app_panier');        
    }

// ====================================================== //
// ===== Supprimer 1 quantité de produit du panier ====== //
// ====================================================== //
        /**
     * @Route("/panier/suppression/{id}", name="app_panier_suppression")
     */
    public function supprQuantitePanier($id) : Response
    {
        $this->panierServices->supprQuantitePanier($id);
        return $this->redirectToRoute('app_panier');
    }

// ====================================================== //
// ==== Supprimer toutes les quantités d'un produit ===== //
// ====================================================== //
/**
     * @Route("/panier/suppression-item/{id}", name="app_panier_suppression_item")
     */
    public function supprItemPanier($id) : Response
    {
        $this->panierServices->supprItemPanier($id);
        return $this->redirectToRoute('app_panier');
    }

}