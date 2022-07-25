<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\model\FiltresSorties;
use App\Form\SortieType;
use App\Form\FiltreSortieType;
use App\Repository\SortieRepository;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/sortie", name="sortie_")
 */
class SortieController extends AbstractController
{
    /**
     * @Route("/list", name="list"), methods={"GET"}
     */

    public function list(SortieRepository $sortieRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $sorties= $sortieRepository->findBy([], [ 'dateHeureDebut' => 'DESC'], 20);
        $filtresSorties = new FiltresSorties();
        $rechercheForm = $this->createForm(FiltreSortieType::class, $filtresSorties);

        $rechercheForm->handleRequest($request);

        if ($rechercheForm->isSubmitted() && $rechercheForm->isValid()) {


        }
        return $this->render('sortie/list.html.twig', [
            'rechercheForm' => $rechercheForm->createView(),
            "sorties" => $sorties
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sortie = new Sortie();


        $sortieForm = $this->createForm(SortieType::class, $sortie);

        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            $entityManager->persist($sortie);
            $entityManager->flush();
        }
        return $this->render('sortie/create.html.twig', [
            'sortieForm' => $sortieForm->createView()
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */

    public function details(int $id, SortieRepository $sortieRepository): Response
    {
        $sortie= $sortieRepository->find($id);

        return $this->render('sortie/details.html.twig', [
            "sortie" => $sortie
        ]);
    }

   /* public function recherche(Request $request, EntityManagerInterface $entityManager) : Response{
        $filtresSorties = new FiltresSorties();
        $rechercheForm = $this->createForm(FiltreSortieType::class, $filtresSorties);

        $rechercheForm->handleRequest($request);

        if ($rechercheForm->isSubmitted() && $rechercheForm->isValid()) {
            $entityManager->persist($filtresSorties);
            $entityManager->flush();
        }


        return $this->render('sortie/list.html.twig', [
            'rechercheForm' => $rechercheForm->createView()
        ]);
    }*/




}