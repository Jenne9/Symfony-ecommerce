<?php

namespace App\Controller\Utilisateur;

use App\Form\UserType;
use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Form\EditAdresseType;
use App\Services\PanierServices;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


    /**
     * @Route("/adresse")
     */

class AdresseController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="app_admin_adresse_index", methods={"GET"})
     */
    public function index(AdresseRepository $adresseRepository ): Response
    {
        return $this->render('admin_produit/index.html.twig', [
            'adresses' => $adresseRepository->findAll(),
                
        ]);
    }
    /**
     * @Route("/new", name="app_adresse_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AdresseRepository $adresseRepository, PanierServices $panierservices): Response
    {
        
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $adresse->setUser($user);
            $adresseRepository->add($adresse, true);

            $this->addFlash('adresse_message', 'Votre adresse a bien été ajoutée');
            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/new.html.twig', [
            'adresse' => $adresse,            
            'form' => $form,
        ]);
    }
        /**
     * @Route("/{id}", name="app_adresse_show", methods={"GET"})
     */
    public function show(Adresse $adresse): Response
    {
        return $this->render('adresse/show.html.twig', [
            'adresse' => $adresse,
        ]);
    }
        /**
     * @Route("/{id}/edit", name="app_adresse_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adresseRepository->add($adresse, true);

            if($this->session->get('paiement_data')){
                $data = $this->session->get('paiement_data');
                $data['adresse'] = $adresse;
                $this->session->set('paiement_data', $data);
                
                return $this->redirectToRoute('app_paiement_confirmer');
            }
            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }
        /**
     * @Route("/{id}", name="app_adresse_delete", methods={"POST"})
     */
    public function delete(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->request->get('_token'))) {
            $adresseRepository->remove($adresse, true);
        }

        return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
    }
}






