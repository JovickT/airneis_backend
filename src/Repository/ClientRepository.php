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
                // $userData['mdp'] = $user->getPassword(); //pour debug (à supprimer)
                $role = $user->getRoles();
                if($role){
                    $userData['role'] = implode($role);
                }else{
                    $userData['role'] = '';
                }
                $adresses = $user->getAdresses();
                $adresseStrings = [];
                foreach ($adresses as $adresse) {
                    $adresseStrings[] = $adresse->getRue() . ' ' . $adresse->getCodePostal() . ' ' . $adresse->getVille();
                }
                $userData['adresses'] = implode('; ', $adresseStrings);
        
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

        public function save(Client $client): void
        {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($client);
            $entityManager->flush();
        }

        public function generatePassword($length = 8) {
            $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $lowercase = 'abcdefghijklmnopqrstuvwxyz';
            $digits = '0123456789';
        
            // Ensure at least one character from each character set is included
            $password = '';
            $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
            $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
            $password .= $digits[random_int(0, strlen($digits) - 1)];
        
            // Fill the remaining length with a random selection of characters from all sets
            $allCharacters = $uppercase . $lowercase . $digits;
            for ($i = 3; $i < $length; $i++) {
                $password .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
            }
        
            // Shuffle the password to ensure randomness
            $password = str_shuffle($password);
        
            return $password;
        }

}
