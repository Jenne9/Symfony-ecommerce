<?php
namespace App\Services;

use App\Repository\ProduitRepository;
// Permet la sauvegarde des données dans la session
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierServices{

	private $session;
	private $produitRepository;
	private $tva = 0.2 ;

	public function __construct(SessionInterface $session, ProduitRepository $produitRepository)
	{
		//Initialisation de la session
	
		$this->session = $session;
		$this->produitRepository = $produitRepository;
	}

	//Actions du panier

// ====================================================== //
// ============ Ajouter 1 produit au panier ============= //
// ====================================================== //
	public function addPanier($id){
		//On récupère le contenu du panier
		$panier = $this->getPanier();
		//On vérifie si le produit est déjà dans le panier
		if(isset($panier[$id])){
			//déjà dans le panier, donc on incrémente les quantités
			$panier[$id]++;
		} else{
			//n'est pas dans le panier, donc on ajoute 1 quantité
			$panier[$id] = 1;
		}
		//Mise à jour du panier
		$this->updatePanier($panier);

	}

// ====================================================== //
// ===== Supprimer 1 quantité de produit du panier ====== //
// ====================================================== //
	public function supprQuantitePanier($id){
		//On récupère le contenu du panier
		$panier = $this->getPanier();
		//On vérifie si le produit est déjà dans le panier
		if(isset($panier[$id])){
			//si le produit a plusieurs quantités, si oui, on décrémente
			if($panier[$id] > 1){
				$panier[$id]--;
			} else{
				//s'il n'y en a qu'un, on le supprime avec la méthode unset()
				unset($panier[$id]);
			}
		//Mise à jour du panier
		$this->updatePanier($panier);
		}
	}

// ====================================================== //
// ==== Supprimer toutes les quantités d'un produit ===== //
// ====================================================== //
	public function supprItemPanier($id){
		//On récupère le contenu du panier
		$panier = $this->getPanier();
		//On vérifie si le produit est déjà dans le panier, si oui, on le supprime
		if(isset($panier[$id])){
			unset($panier[$id]);
		}
		//Mise à jour du panier
		$this->updatePanier($panier);
	}

// ====================================================== //
// ======= Supprimer tous les produits du panier ======== //
// ====================================================== //
	public function supprAllPanier(){
		$this->updatePanier([]);
	}


// ====================================================== //
// ============== Mettre à jour le panier =============== //
// ====================================================== //
	public function updatePanier($panier){
		//On récupère la session, et on modifie le panier via le set. On prend la clé 'panier' et on lui set le contenu dans son paramètre $panier
		$this->session->set('panier', $panier);
		$this->session->set('panierData', $this->allItemsPanier());
	}

// ====================================================== //
// ========== Contenu du panier d'une session =========== //
// ====================================================== //
	public function getPanier(){
		//On récupère le contenu du panier via le get. On prend la clé 'panier' et on passe un array vide au cas ou le panier est vide
		return $this->session->get('panier',[]);
	}

// ==================================================== //
// ===  Récupération de tous les produits du panier === //
// ==================================================== //
	public function allItemsPanier(){

		$panier = $this->getPanier();
		$fullPanier = [];
		$quantite_panier = 0;
		$sousTotal = 0;


		//On parcoure le panier. On utilise le repository de Produit
		foreach ($panier as $id => $quantite){
			//recuperation du produit
			$produit = $this->produitRepository->find($id);

			if($produit){
				//Produit récupéré avec succès
				if($quantite >$produit ->getQuantite()){
					$quantite = $produit->getQuantite();
					$panier[$id] = $quantite;
					$this->updatePanier($panier);
				}
				$fullPanier['produits'][]= 
				[
					"quantity" => $quantite,
					"produit" => $produit
				];
				$quantite_panier += $quantite;
				$sousTotal += $quantite * $produit->getPrix();
			}else{
				//Si on ne trouve pas de produit c'est que l'id est incorrect
				$this->supprItemPanier($id);
			}
			$fullPanier['data'] = [
				"quantite_panier" => $quantite_panier,
				"sousTotalHT" => $sousTotal,
				"tva" => round($sousTotal*$this->tva,2),
				"sousTotalTTC" => round(($sousTotal + ($sousTotal*$this->tva)), 2)
			];
		}
		return $fullPanier;
	}



}

