<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isTrue;

class VilleController extends AbstractController


{
    #[Route('/villes', name:'main_villes')]

    public function list( VilleRepository $villeRepository, Request $request, EntityManagerInterface $entityManager){

        $villes = $villeRepository->findBy([], ['nom' => 'DESC']);

        $ville= new Ville();
        $villeForm = $this->createForm(VilleType::class, $ville) ;
        $villeForm->handleRequest($request);

        if($villeForm->isSubmitted() && $villeForm->isValid()) {
            $entityManager->persist($ville);
            $entityManager->flush();

            $this->addFlash('success', 'La ville a été ajoutée');

        }

        return $this->render('main/villes.html.twig', [
            "villes" => $villes,
            'villeForm' => $villeForm->createView()

                   ]);

    }

#[Route('/villes/delete/{id}', name:'villes_delete')]



public function removeVille(int $id, EntityManagerInterface $entityManager, Ville $ville, VilleRepository $villeRepository){

        $ville= $villeRepository->find($id);
        $entityManager->remove($ville);
        $entityManager ->flush();
        $this->addFlash('success', 'La ville a été supprimée');
        return $this->redirectToRoute('main_villes');


}

public function modifVille($id, Request $request, VilleRepository $villeRepository)
{
    $ville = $this->$villeRepository->findOneBy(['id' => $id]);
    $data = $request->getContent();

    empty($data['nom'])? isTrue() : $ville->setNom ($data['nom']);
    empty($data['codePostal'])? isTrue() : $ville->setCodePostal ($data['nom']);
}

    /*public function ajoutVille(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ville = new Ville();
        $villeForm = $this->createForm(VilleType::class, $ville);

        $villeForm->handleRequest($request);

        if($villeForm->isSubmitted() && $villeForm->isValid()) {
            $entityManager->persist($ville);
            $entityManager->flush();

            }
        return $this->render('main/villes.html.twig', [
            'villeForm' => $villeForm->createView()
        ]);
    }*/
}