<?php

namespace App\Controller;

use App\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $manager): Response
    {
        // récupération des articles depuis la BDD
        $dataArticles = $manager->getRepository(Article::class)->findAll(); 
        //dd( $dataArticles);
        // modification données pour l'affichage du prix
    //    $write = function (Article $f){
    //         $f->setPrice(10);
    //         return $f;
    //    };
    //    $datasToDisplay = array_map($write,$dataArticles);
        // envoie des données
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
             'dataArticles' => $dataArticles ,
            // 'dataArticles' => $datasToDisplay,
        ]);
    }
}
