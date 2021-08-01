<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    /**
     * @Route("/client/cars", name="cars")
     */
    public function index(VoitureRepository $repo): Response
    {
        $voitures = $repo->findAll();

        return $this->render('car/index.html.twig', [
            "voitures" => $voitures
        ]);
    }
}
