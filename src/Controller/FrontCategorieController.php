<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontCategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="app_categorie")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('front_categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="app_categorie_show")
     */
    public function show(CategorieRepository $categorieRepository, int $id): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categories' => $categorieRepository->find($id),
        ]);
    }
}
