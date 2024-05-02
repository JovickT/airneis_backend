<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    //    /**
    //     * @return Client[] Returns an array of Client objects
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

    //    public function findOneBySomeField($value): ?Client
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

        public function getAllUsers(){
            $users = $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult();

            $usersArray = [];
            foreach ($users as $user) {
                $userData = [];
                // $userData['id'] = $user->getIdClient();
                $userData['prenom'] = $user->getPrenom();
                $userData['nom'] = $user->getNom();
                $userData['email'] = $user->getEmail();
                $userData['telephone'] = $user->getTelephone();
                $role = $user->getRole();
                if($role){
                    $userData['role'] = 'Admin';
                }else{
                    $userData['role'] = 'Client';
                }
                $adresse = $user->getAdresse();
                if ($adresse) {
                    $userData['adresse'] = $adresse->getRue().' '.$adresse->getCodePostal().' '.$adresse->getVille();
                } else {
                    $userData['adresse'] = null;
                }
        
                $usersArray[] = $userData;
            }

            return $usersArray;
        }

        public function getAllEmails(): array
        {
            $emails = $this->createQueryBuilder('c')
                ->select('c.email')
                ->getQuery()
                ->getResult();

            $emailList = array_column($emails, 'email');

            return $emailList;
        }


}
