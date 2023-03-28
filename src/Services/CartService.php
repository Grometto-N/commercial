<?php

namespace App\Services;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

use App\Repository\ArticleRepository;

use App\Entity\Article;


// gestion des données dans la sesssion (surtout pour le panier)

class CartService
{
    private SessionInterface $session;
    private ArticleRepository $articleRepository;
    
    public function __construct(SessionInterface $session, ArticleRepository $articleRepository)
    {   
        $this->session = $session;
        $this->articleRepository = $articleRepository;
    }

    // obtenir tous les articles du panier : infos + quantité
    public function getCartDatas():array
    {
        $cart = $this->session->get('cart',[]);

        $datasArticles =[];

        foreach($cart as $id=> $quantity){
            $datasArticles[] = [
                                'article' => $this->articleRepository->find($id),
                                'quantity' => $quantity,
                                ];
        }

        return $datasArticles;
    }

    // ajout d'un article
    public function add($id):void 
    {
        $cart = $this->session->get('cart',[]);

        if(empty($cart[$id])){
            $cart[$id] = 1;
        }else{
            $cart[$id]++;
        }

        $this->session->set('cart', $cart);
    }

    // suppression d'un article
    public function remove($id):void 
    {
        $cart = $this->session->get('cart',[]);

        if(!empty($cart[$id]))
        {
            if($cart[$id]>1){
                $cart[$id]--;
            }else{
                $cart[$id] = 0;
            }
        }

        $this->session->set('cart', $cart);
    }

}