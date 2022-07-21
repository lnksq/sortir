<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\SortieRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/sorties", name="sortie_")
 */
class SortieController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */

    public function list(SortieRepository $sortieRepository): Response
    {
    $sorties= $sortieRepository->findBy([], [ 'dateHeureDebut' => 'DESC'], 50);
        return $this->render('sortie/list.html.twig', [
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



        return $this->render("sortie/create.html.twig", [
                "sortieForm" => $sortieForm->createView()
        ]);
        }




}