<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 27/09/2019
 * Time: 23:28
 */

namespace App\Controller;

use App\Entity\Favorite\Favorite;
use App\Entity\Product\Product;
use App\Entity\User\ShopUser;
use App\Form\AddFavoriteFormType;
use Sylius\Bundle\UserBundle\Controller\UserController;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductRepository;


class ShopUserController extends UserController
{



    public function addFavoriteProduct($product)
    {

        $user = $this->getUser()->getId();
        $shopUser = $this->getDoctrine()->getRepository(ShopUser::class)->find($user);
        $product = $this->getDoctrine()->getRepository(Product::class)->getFavoriteProduct($product);


        $em = $this->getDoctrine()->getManager();
        $product->addShopUser($shopUser);
        $em->persist($product);
        $em->flush();


        return $this->redirectToRoute('sylius_shop_product_show',['slug' => $product->getSlug()]);

    }


    public function getFavoritesProducts($id)
    {

          $user = $this->getDoctrine()->getRepository(ShopUser::class)->find($id);
          $product = $this->getDoctrine()->getRepository(Product::class)->getFavoritesProducts($id);


          return $this->render('@SyliusShop/Product/Favorite/form.html.twig',[
              'user' => $user,
             'product' =>$product

          ]);


    }



}

;

