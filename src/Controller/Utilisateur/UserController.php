<?php

namespace App\Controller\Utilisateur;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Form\EditProfilType;
use App\Form\EditPasswordType;
use App\Repository\UserRepository;
use App\Repository\PanierRepository;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DetailsPanierRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/user", name="app_user")
     */
    public function index(AdresseRepository $adresseRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'adresses'=>$adresseRepository->findAll()
        ]);
    }

    public function commande(DetailsPanierRepository $panierRepository): Response
    {
        $panier = $panierRepository->findBy(['prix'=> 669]);
        dd($panier);

        return $this->render('user/index.html.twig');
    }
    /**
     * @Route("/user/profil/modifier", name="app_user_profil_modifier", methods={"GET", "POST"})
     */

    public function EditProfile(Request $request, EntityManagerInterface $entityManager)   
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
        
            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }
            return $this->renderForm('user/edit-profil.html.twig', [
                'user'=> $user,
                'form' => $form,
            ]);
    }

    /**
     * @Route("/user/password/modifier", name="app_user_password_modifier", methods={"GET", "POST"})
     */

    public function EditPassword(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher) : Response 
    {
        $user = $this->getUser();
        $form = $this->createForm(EditPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $oldPass = $form->get('plainPassword')->getData();
            if($userPasswordHasher->isPasswordValid($user, $oldPass))
                {
                    $newPass = $form->get('newpassword')->getData();
                    $password = $userPasswordHasher->hashPassword($user, $newPass);

                    $user->setPassword($password);
                    $entityManager->persist($user);
                    $entityManager->flush();
                }
            
        } 
        return $this->render('user/edit-password.html.twig', [            
            'form' => $form->createView(),
        ]);
    }





}