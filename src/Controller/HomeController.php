<?php

namespace App\Controller;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ArticleType;
use App\Form\Categorie;
use Symfony\Component\Validator\Date;
use Symfony\Component\Validator\Constraints\DateTimeInerface;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepository)
    {
        $articles=$articleRepository->findAll();

        /**dump($articles);
        die();
        or dd($articles) */

        return $this->render('home/index.html.twig', [
            'articles' =>$articles
        ]);
    }
    /**
     * @Route("article/new", name="article_new")
     */

    public function new(Request $request)
    {
        $article=new Article();
        $form=$this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $article->setCreatedat(new DateTimeInterface());
            $article->setImage("https://picsum.photos/seed/picsum/350/150");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute("article_show", ['id' => $article->getId()]);
        }

        return $this->render('home/new.html.twig', [
            'form' =>$form->createView()
        ]);
    } 

    /**
     * @Route("article/{id}", name="article_show")
     */

    public function show(Article $article)
    {
        return $this->render('home/show.html.twig',[
        'article' => $article
        ]);
    }

    
}
