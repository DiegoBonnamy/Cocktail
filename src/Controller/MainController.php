<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CocktailRepository;
use App\Repository\CouleurRepository;
use App\Entity\Cocktail;
use App\Form\CocktailType;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(CocktailRepository $repo): Response
    {
        $cocktails = $repo->findAll();

        return $this->render('main/index.html.twig', [
            'cocktails' => $cocktails
        ]);
    }

    /**
     * @Route("/ajouter", name="ajouter")
     */
    public function ajouter(CouleurRepository $repo, Request $request): Response
    {
        $couleurs = $repo->findAll();

        $cocktail = new Cocktail();
        $form = $this->createForm(CocktailType::class, $cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cocktail);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('ajouter/index.html.twig', [
            'form' => $form->createView(),
            'couleurs' => $couleurs
        ]);
    }
}
