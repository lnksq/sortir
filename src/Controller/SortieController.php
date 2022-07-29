<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\model\FiltresSorties;
use App\Form\SortieType;
use App\Form\FiltreSortieType;
use App\Repository\EtatRepository;
use App\Repository\SortieRepository;

use DeepCopy\TypeFilter\TypeFilter;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


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
        $participant = $request->get("participant");
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
    public function create(Request $request, EntityManagerInterface $entityManager, EtatRepository $etatRepository): Response
    {
        $sortie = new Sortie();


        $sortieForm = $this->createForm(SortieType::class, $sortie);

        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
                $organisateur = $this->getUser();
                $sortie->setOrganisateur($organisateur);
                $sortie->addParticipant($organisateur);
                if ($sortieForm->get('enregistrer')->isClicked()){
                $etat= $etatRepository->findOneBy(["libelle"=>"Créée"]);
                $sortie->setEtat($etat);
                $entityManager->persist($sortie);

            $entityManager->flush();

        } elseif ($sortieForm->get('publierSortie')->isClicked()){
                $etat= $etatRepository->findOneBy(["libelle"=> 'Ouverte']);
                $sortie->setEtat($etat);
                $entityManager->persist($sortie);
                $entityManager->flush();
        } elseif ($sortieForm->get('annuler')->isClicked()){
                    $etat= $etatRepository->findOneBy(["libelle"=> 'Annulée']);
                    $sortie->setEtat($etat);

        }
        return $this->redirectToRoute('sortie_list');
            }


        return $this->render('sortie/create.html.twig', [
            'sortieForm' => $sortieForm->createView(),
            'sortie'=>'$sortie'
        ]);
    }


    /**
     * @Route("/details/{id}", name="details")
     */

    public function details(int $id, SortieRepository $sortieRepository): Response
    {
        $sortie= $sortieRepository->find($id);
        if($sortie != null) {
            return $this->render('sortie/details.html.twig', [
                "sortie" => $sortie]);
        }else{return $this->redirectToRoute('sortie_details');}
    }

    /**
     * @Route("/join/{id}/api/join", name="join")
     */

    public function join(int $id, SerializerInterface $serializer, SortieRepository $sortieRepository, EntityManagerInterface $entityManager)
    {
        $sortie = $sortieRepository->find($id);
        $participant = $this->getUser();
        $sortie->addParticipant($participant);
        $entityManager->persist($sortie);
        $entityManager->flush();
        $response= new Response();
        $response->headers->set("Content-type", "application/jason");
        $json= $serializer->serialize($sortie, "json", ["groups"=> "sortie"]);
        $response->sendContent($json);


    }



}