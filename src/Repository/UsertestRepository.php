<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class UsertestRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public  function findByname($userid){


        $query = $this->getEntityManager()->createQuery(" SELECT u  FROM  App\Entity\User AS  u WHERE u.username=:userid")->setParameter('userid',$userid);

        return $query->getResult();
        /* try {
             return $query->getOneOrNullResult();
         } catch (NoResultException $e) {
             return null;
         } catch (NonUniqueResultException $e) {
             return null;
         }*/

    }
}