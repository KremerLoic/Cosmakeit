<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 26/09/2019
 * Time: 19:22
 */

namespace App\Repository;

use Sylius\Component\Core\Repository\ProductRepositoryInterface as BaseProductRepositoryInterface;

interface ProductRepositoryInterface extends BaseProductRepositoryInterface
{

    public function findPreferedProduct(int $limit): array;

    public function getFavoriteProduct(int $slug): int;

}