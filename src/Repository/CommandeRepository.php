<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
 
/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }
   

    public function countCommandesByClientId(int $clientId): int
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.commandeId)')
            ->andWhere('c.clientId = :clientId')
            ->setParameter('clientId', $clientId)
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function searchCommandes(string $searchTerm): array
{
    return $this->createQueryBuilder('c')
        ->where('c.dateCommande LIKE :searchTerm')
        ->orWhere('c.montantTotal LIKE :searchTerm')
        ->orWhere('c.adresseLivraison LIKE :searchTerm')
        ->orWhere('c.dateLivraison LIKE :searchTerm')
        ->orWhere('c.modePaiement LIKE :searchTerm')
        // Add more fields as needed
        ->setParameter('searchTerm', '%' . $searchTerm . '%')
        ->getQuery()
        ->getResult();
    }  

//    /**
//     * @return Commande[] Returns an array of Commande objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Commande
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
} 