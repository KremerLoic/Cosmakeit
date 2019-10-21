<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 29/09/2019
 * Time: 18:04
 */

namespace App\Repository;




use App\Entity\Favorite\Favorite;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method Favorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favorite[]    findAll()
 * @method Favorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class FavoriteRepository extends EntityRepository

{



    public function getFavoritesProducts($id){

        return $this->createQueryBuilder('f')
            ->addSelect('product')
            ->leftJoin('f.products', 'product' )
            ->andWhere('f.user = :id')
            ->setParameter('id' , $id)
            ->getQuery()
            ->getResult()
            ;
    }



}