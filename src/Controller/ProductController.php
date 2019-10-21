<?php

namespace App\Controller;


use App\Entity\Customer\Customer;
use App\Entity\Product\Product;
use FOS\RestBundle\View\View;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;


class ProductController extends ResourceController


{




    public function getPreferedTaxon($id, Security $security, Customer $customer)
    {

        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $securityName = $security->getUser();
        $customerName = $customer->getEmail();


        //if ($securityName == $customerName) {
        return $this->render('@SyliusShop/Product/Preference/_mainFavourites.html.twig', [
            'products' => $products,
            'customer' => $customer,
            'securityName' => $securityName,
            'customerName' => $customerName,
        ]);
        // } else {
        //    return $this->redirectToRoute('sylius_shop_homepage',[

        //     ]);

        // }
    }



}
