<?php

namespace App\Repository;

use App\Entity\Sortie;
use App\Form\model\FiltresSorties;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sortie>
 *
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function add(Sortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findSorties(FiltresSorties $filtresSorties )//User $user
    {
        $qb = $this->createQueryBuilder('s');

        if ($filtresSorties->getCampus()) {
            $qb
                ->where("s.campus = :campus")
                ->setParameter("campus", $filtresSorties->getCampus());
        }
        if ($filtresSorties->getMotRecherche()) {
            $qb
                ->andWhere("s.nom LIKE :motRecherche")
                ->setParameter('motRecherche', '%' . $filtresSorties->getMotRecherche() . '%');
        }
        if($filtresSorties->getPremiereDate() && $filtresSorties->getDerniereDate()) {
           $qb
               ->andWhere("s.dateHeureDebut > :premiereDate and s.dateHeureDebut < :derniereDate")
                ->setParameter('premiereDate', $filtresSorties->getPremiereDate())
               ->setParameter('derniereDate', $filtresSorties->getDerniereDate());

        }
        return $qb->getQuery()->getResult();
    }
}
//
//
//        if ($filtresSorties->getOrganisateur() ){
//
//        }
//
//        if($filtresSorties->getInscrit()) {
//        }
//
//        if($filtresSorties->getPasInscrit()){
//        }
//
//        if($filtresSorties->getSortiesPassees()) {
//        }
//
//        }








           // $qb->expr()->orX(
               // $qb->expr()
              // $qb->expr()->isNotNull('s.date), ));
        
       // }
    //}
            

           
                
        //return $qb->getQuery()->getResult();


//    /**
//     * @return Sortie[] Returns an array of Sortie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sortie
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

