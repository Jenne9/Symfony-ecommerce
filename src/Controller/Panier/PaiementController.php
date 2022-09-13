<?php

namespace App\Controller\Panier;

use App\Entity\Panier;
use App\Entity\Adresse;
use App\Form\PaiementType;
use App\Services\PanierServices;
use App\Services\CommandeServices;
use App\Repository\AdresseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaiementController extends AbstractController
{
    private $panierServices;
    private $session;

    public function __construct(PanierServices $panierServices, SessionInterface $session)
    {
        $this->panierServices = $panierServices;
        $this->session = $session;
    }

    /**
     * @Route("/paiement", name="app_paiement")
     */
    public function index( Request $request): Response
    {
        $user =$this->getUser();
        $panier = $this->panierServices->AllItemsPanier();

        if(!($panier)){
            return $this->redirectToRoute('app_front_accueil');
        }
        if(!$user->getAdresses()->getValues()){
            $this->addFlash('paiement.message', "Merci d'ajouter un adresse");
            return $this->redirectToRoute('app_adresse_new');
        }       

        if($this->session->get('paiment_data')){

        }

        $form = $this->createForm(PaiementType::class, null,['user'=>$user]);       

        return $this->render('paiement/index.html.twig', [
            'panier'=>$panier,
            'paiement'=> $form->createView()
        ]);
    }

    /**
     * @Route("/paiement/confirmer", name="app_paiement_confirmer")
     */
    public function confirme(Request $request, CommandeServices $commandeServices): Response
    {
        $user =$this->getUser();
        $panier = $this->panierServices->AllItemsPanier();

        if(!($panier)){
            return $this->redirectToRoute('app_front_accueil');
        }
        if(!$user->getAdresses()->getValues()){
            $this->addFlash('paiement.message', "Merci d'ajouter un adresse");
            return $this->redirectToRoute('app_adresse_new');
        }

        $form = $this->createForm(PaiementType::class, null,['user'=>$user]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() || $this->session->get('paiement_data')){

            if($this->session->get('paiement_data')){
                $data = $this->session->get('paiement_data');
            }else{
                $data = $form->getData();
                $this->session->set('paiement_data', $data);
            }
            
            $adresse = $data['adresse'];
            $transporteur = $data['transporteur'];
            $information = $data['information'];
            
            // Sauvegarde du panier
            $panier['paiement'] = $data;
            $reference = $commandeServices->sauvegardePanier($panier,$user);
            
            
            return $this->render('paiement/confirmer.html.twig', [
                'adresse'=> $adresse,
                'transporteur'=> $transporteur,
                'information'=> $information,
                'panier'=> $panier,
                'reference'=> $reference,
                'paiement'=> $form->createView()
            ]);
        }
        return $this->redirectToRoute('app_paiement');
    }

    /**
     * @Route("/paiement/modifier", name="app_paiement_modifier")
     */
    public function modifierConfirmation():Response 
    {
        $this->session->set('paiement_data', []);
        return $this->redirectToRoute('app_paiement');
    }

}
