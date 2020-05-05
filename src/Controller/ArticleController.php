<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article/")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("liste_article", name="article")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $articles = $entityManager->getRepository(Article::class)->findAll();

        return $this->render('article/index.html.twig', compact("articles"));
    }

    /**
     * @Route("create", name="create")
     */
    public function create(EntityManagerInterface $entityManager){
        $article = new Article();

        $article->setDesignation("stylo");
        $article->setPrix(5.3);
        $article->setMarque("Truc");

        try{
            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash(
                "success",
                "Insertion réussie  !!!!"
            );
        }catch (UniqueConstraintViolationException $u){
            $this->addFlash(
                "warning",
                "Impossible de dupliquer le champ ". $article->getDesignation()
            );
        }

        return $this->redirectToRoute("article");
    }

    /**
     * @Route("delete/{id_art}", name="delete")
     */
    public function delete($id_art, EntityManagerInterface $entityManager){
        $art = $entityManager->getRepository(Article::class)->find($id_art);

        $entityManager->remove($art);
        $entityManager->flush();

        return $this->redirectToRoute("article");
    }
}
