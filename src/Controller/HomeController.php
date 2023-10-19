<?php

namespace App\Controller;
// on importe notre classe depuis ArticleRepository
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    // on mettre notre class dans la la () de index et on cree une variable de meme type k la class et le mettre ausi dans la (). les dependances
    public function index(ArticleRepository $articleRepository, CategoryRepository $CategoryRepository): Response
    {
        //  $articles cest une variable qui stock le tableau associatif pris à la methode findAll
        $articles = $articleRepository->findAll();
        $categories = $CategoryRepository->findAll();
        
        // dd() cest comme var_dump
        // dd($articles);
        //  echo "<pre>";
        // var_dump ($articles);
        //    echo "</pre>";
        // pour afficher dans le navigateur il faut passer par render, metre une clé=> variable
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            // "article1" => $articles : Vous ajoutez une clé "article1" au tableau associatif, et vous y affectez la valeur de la variable $articles,
            //  qui contient la liste des articles récupérée à partir de la base de données. Cette clé et sa valeur sont utilisées pour afficher 
            // les articles dans votre modèle Twig 'home/home.html.twig'.
            // 
            "articles"=> $articles,
            // "articles1"=> $articles
             "categories"=> $categories
        ]);
    }
// deuxieme methode recupere un article
// '/show/{id}'ou /x/{id}'comme on v, on fait apl a id dans show pour requiperer un article par id.name: 'show'cad nom de l'apelation donc on peut metre x a la place de show
    #[Route('/show/{id}', name: 'show')]
    public function show(int $id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException('L\'article n\'a pas été trouvé.');
        }
        return $this->render('home/show.html.twig', [
            'article' => $article,
        ]);
    }





    // on veut afficher les categories sur la meme page que les autres cad home
    // #[Route('/home/{id}', name: 'app_home')]
    // public function unCategory(int $id, CategoryRepository $CategoryRepository): Response
    // {
    //    $categories  = $CategoryRepository->find($id);
    //     if (!$categories) {
    //         throw $this->createNotFoundException('L\'category n\'a pas été trouvé.');
    //     }
    //     return $this->render('homehome.html.twig', [
    //         'categorie' => $categories,
    //     ]);
    // }



}
