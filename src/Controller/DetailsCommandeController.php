<?php

namespace App\Controller;

use App\Repository\DetailsCommandeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailsCommandeController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/details/commande", name="app_details_commande")
     */
    public function index(DetailsCommandeRepository $detailsCommandeRepository): Response
    {
        return $this->render('details_commande/index.html.twig', [
            'detailscommandes' => $detailsCommandeRepository->findAll(),
            
        
        ]);
    }
}
