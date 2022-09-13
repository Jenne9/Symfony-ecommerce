<?php

namespace App\Controller\Stripe;

use Stripe\Stripe;
use App\Entity\Panier;
use App\Services\CommandeServices;
use Stripe\Checkout\Session;
use App\Services\PanierServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    /**
     * @Route("/create-checkout-session", name="create_checkout_session")
     */
    public function index(PanierServices $panierServices): Response
    {


        $panier = $panierServices->allItemsPanier();


        Stripe::setApiKey('sk_test_51LcEltBP88TJivThxr2CVYsmcTf4wVZnYEwDcvKmn3JLc7sAgEcJK50cCIe7qP5Gqarjh5diB3rVxQmeeF51MS2y00gIAfSgmY')
        ;

        $line_items = [];
        foreach ($panier['produits'] as $data_produit) {    
            
            $produit = $data_produit['produit'];
            $line_items[] = [
                'price_data' =>[
                    'currency'=>'eur',
                    'unit_amount'=> $produit->getPrix()*100,
                    'product_data'=>[
                        'name'=>$produit->getNom(),
                        // 'images'=> [$_ENV['YOUR_DOMAIN'].'public/images/' ~ produit],
                    ],
                ],
                'quantity'=>$data_produit['quantity']
            ];
        }

        $checkout_session = Session::create([            
            'payment_method_types'=>['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => $_ENV['YOUR_DOMAIN'] . '/stripe-success-payment',
            'cancel_url' => $_ENV['YOUR_DOMAIN'].'/stripe-cancel-payment',
        ]);

        // return $this->json(['id'=>$checkout_session->url]);
        return $this->redirect($checkout_session->url);
    }
}
