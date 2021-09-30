<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FruitRepository;
use App\Entity\Couleur;

class ApiController extends AbstractController
{

    /**
     * @Route("/api/couleurs/{id}", name="api_couleurs" ,methods={"GET"})
     */
    public function api_couleurs(Couleur $couleur, FruitRepository $repo): Response
    {
        $fruits = $repo->findBy(
            ['couleur' => $couleur->getId()]
        );

        return $this->json($fruits);
    }

}
