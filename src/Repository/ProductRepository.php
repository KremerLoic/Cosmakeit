<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 26/09/2019
 * Time: 19:11
 */

namespace App\Repository;


use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;


class ProductRepository extends BaseProductRepository
{

    /**
     * @param int $limit
     * @inheritdoc
     */
    public function findPreferedProduct($limit): array
    {

        return $this->createQueryBuilder('o')
            ->addSelect('variant')
            ->addSelect('translation')
            ->leftJoin('o.variants', 'variant')
            ->leftJoin('o.translations', 'translation')
            ->andWhere('o.enabled = true')
            ->orderBy('RAND()')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }


    public function getFavoriteProduct($slug){

        return $this->createQueryBuilder('p')
            ->addSelect('translation')
            ->addSelect('variant')
            ->leftJoin('p.variants', 'variant')
            ->leftJoin('p.translations', 'translation')
            ->andWhere('translation.slug = :slug')
            ->setParameter('slug' , $slug)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }


    public function getFavoritesProducts($id){

        return $this->createQueryBuilder('p')
            ->andWhere(':id MEMBER of p.shopUsers')
            ->setParameter('id' , $id)
            ->getQuery()
            ->getResult()
            ;
    }



}