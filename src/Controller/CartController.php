<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\CartService;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartService $cartService): Response
    {   
        $datasCart =  $cartService->getCartDatas();
        
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'dataCart' => $datasCart,
        ]);
    }

    #[Route('/cart/add/{id}/redirect/{page}', name: 'app_cart_add')]
    public function add($id, $page, CartService $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute($page);
    }

    #[Route('/cart/remove/{id}/redirect/{page}', name: 'app_cart_remove')]
    public function remove($id, $page, CartService $cartService)
    {
        $cartService->remove($id);
        return $this->redirectToRoute($page);
    }

}
