<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Sortie;
use App\Form\model\FiltresSorties;
use App\Form\SortieType;
use App\Form\FiltreSortieType;
use App\Repository\EtatRepository;
use App\Repository\LieuRepository;
use App\Repository\SortieRepository;

use App\Repository\VilleRepository;
use DeepCopy\TypeFilter\TypeFilter;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\stringContains;


/**
 * @Route("/sortie", name="sortie_")
 */
class SortieController extends AbstractController
{
    /**
     * @Route("/list", name="list"), methods={"GET"}
     */

    public function list(SortieRepository $sortieRepository, Request $request, EntityManagerInterface $entityManager, FormFactoryInterface $formFactory): Response
    {

        $filtresSorties = new FiltresSorties();


        $rechercheForm = $this->createForm(FiltreSortieType::class, $filtresSorties);

        $rechercheForm->handleRequest($request);

        if ($rechercheForm->isSubmitted() && $rechercheForm->isValid()) {
           $sorties= $sortieRepository->findSorties($filtresSorties );//$this->getUser()
        }else{
            $sorties= $sortieRepository->findSorties($filtresSorties); //$this->getUser()
        }
        return $this->render('sortie/list.html.twig', [
            'rechercheForm' => $rechercheForm->createView(),
            "sorties" => $sorties
        ]);
    }


    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager, VilleRepository $villeRepository, EtatRepository $etatRepository): Response
    {
        $sortie = new Sortie();
        $villes = $villeRepository->findAll();

        $sortieForm = $this->createForm(SortieType::class, $sortie);

        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            if($sortieForm->get('enregister')->isClicked()) {
               $etat = $etatRepository->findOneBy(["libelle"=>"Créée"]);
                $sortie->setEtat($etat);
                $entityManager->persist($sortie);
                $entityManager->flush();
            }elseif ($sortieForm->get('publierSortie')->isClicked()){
                $etat = $etatRepository->findOneBy(["libelle"=>"Ouverte"]);
                $sortie->setEtat($etat);

                $entityManager->persist($sortie);
                $entityManager->flush();
            }
        }
        return $this->render('sortie/create.html.twig', [
            'sortieForm' => $sortieForm->createView(),
            'villes' => $villes
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






}