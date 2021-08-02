<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Form\RechercheVoitureType;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    /**
     * @Route("/client/cars", name="cars")
     */
    public function index(VoitureRepository $repo, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $rechercheVoiture = new RechercheVoiture();

        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoiture);
        $form->handleRequest($request);

        $voitures = $paginatorInterface->paginate(
            $repo->findAllWithPagination($rechercheVoiture),
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('car/index.html.twig', [
            "voitures" => $voitures,
            "form" => $form->createView(),
            "admin" => false
        ]);
    }
}
