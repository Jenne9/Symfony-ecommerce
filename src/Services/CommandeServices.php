<?php
namespace App\Services;

use App\Entity\Panier;
use DateTimeImmutable;
use App\Entity\Commande;
use App\Entity\DetailsPanier;
use App\Entity\DetailsCommande;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;

class CommandeServices {

	private $manager;
	private $produitRepository;

	public function __construct(EntityManagerInterface $manager, ProduitRepository $produitRepository)
	{
		$this->manager = $manager;
		$this->produitRepository = $produitRepository;
	}

	public function creerCommande($panier){
		$commande = new Commande();

		$commande->setReference($panier->getReference())
				->setTransporteur($panier->getTransporteur())
				->setTransporteurPrix($panier->getPrix())
				->setNomUser($panier->getNomUser())
				->setAdresseLivraison($panier->getAdresseLivraison())
				->setInformation($panier->getInformations())
				->setQuantite($panier->getQuantite())
				->setSousTotalHT($panier->getSousTotalHT())
				->setTva($panier->getTva())
				->setSousTotalTTC($panier->getSousTotalTTC())
				->setUser($panier->getUser())
				->setCreatedAt(new DateTimeImmutable());
			$this->manager->persist($commande);

			$produits = $panier->getDetailsPanier()->getValues();

			foreach($produits as $panier_produit){

				$detailsCommande = new DetailsCommande();
				$detailsCommande->setCommande($commande)
							->setNomProduit($panier_produit->getProduitNom())
							->setPrix($panier_produit->getProduitPrix())
							->setQuantite($panier_produit->getQuantite())
							->setPrixTotalHt($panier_produit->getPrixTotalHt())
							->setPrixTotalTtc($panier_produit->getPrixTotalTtc())
							->setTva($panier_produit->getTva());
				$this->manager->persist($detailsCommande);				

			}
			$this->manager->flush();
			return $commande;
			
	}

	public function getLineItems($panier){
		$detailsPanier = $panier->getDetailsPaniers();

		$lineItems = [];
		foreach	($detailsPanier as $details){
			$produit = $this->produitRepository->findOneByNom($details->getNomProduit());
			
			$line_items[] = [
                'price_data' =>[
                    'currency'=>'eur',
                    'unit_amount'=> $produit->getPrix()*100,
                    'product_data'=>[
                        'name'=>$produit->getNom(),
                        // 'images'=> [$_ENV['YOUR_DOMAIN'].'public/images/' ],
                    ],
                ],
                'quantity'=>$details->getQuantite(),
            ];
		}
	}

	public function sauvegardePanier($data, $user){
//instance d'un nouvel objet panier
		$panier = new Panier();{
			$reference = $this->genererUuid();
			//je recupère l'adresse, le transporteur et les info via leur clé
			$adresse = $data['paiement']['adresse'];
			$transporteur = $data['paiement']['transporteur'];
			$information = $data['paiement']['information'];

		// modification des données via les set() et récupération par les get()
			$panier->setReference($reference)
				->setTransporteur($transporteur->getNom())
				->setTransporteurPrix($transporteur->getPrix())
				->setNomUser($user->getNom())
				->setAdresseLivraison($adresse)
				->setInformation($information)
				->setQuantite($data['data']['quantite_panier'])
				->setSousTotalHT(($data['data']['sousTotalHT']))
				->setTva(round($data['data']['tva'], 2))
				->setSousTotalTTC(round(($data['data']['sousTotalTTC']+$transporteur->getPrix()),2))
				->setUser($user)
				->setCreatedAt(new DateTimeImmutable());
			$this->manager->persist($panier);

			$detailsPanier_array = [];
			foreach($data['produits'] as $produits){

				$detailsPanier = new DetailsPanier();
				$prixTotal = $produits['quantity'] * $produits['produit']->getPrix();

				$detailsPanier->setPanier($panier)
							->setNomProduit($produits['produit']->getNom())
							->setPrix($produits['produit']->getPrix())
							->setQuantite($produits['quantity'])
							->setPrixTotalHt($prixTotal)
							->setPrixTotalTtc($prixTotal*1.2)
							->setTva($prixTotal*0.2);
				$this->manager->persist($detailsPanier);
				$detailsPanier_array[] = $detailsPanier;

			}
			$this->manager->flush();
			return $reference;
		}
	}

	// retourne un id unique servant de référence à la sauvegarde du panier en BDD
	public function genererUuid(){

		// Initialise le generateur de nombre aléatoires Marsenne Twister
		mt_srand((double)microtime()*100000);
		
		//strtoupper  :Renvoi de string en majuscule
		// uniqid : Genere un id unique
		$charid = strtoupper(md5(uniqid(rand(), true)));

		//generer un chaine d'un octet à partir d'un nombre
		$hyphen = chr(45);

		//substr : retourne un segment de chaine
		$uuid = ""
		.substr($charid, 0, 8).$hyphen
		.substr($charid, 8, 4).$hyphen
		.substr($charid, 12, 4).$hyphen
		.substr($charid, 16, 4).$hyphen
		.substr($charid, 20, 12).$hyphen;
		return $uuid;
	}




}