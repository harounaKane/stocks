<?php

namespace App\Controller;

use App\Entity\Article;
use App\form\FormArticle;
use App\Repository\ArticleRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article/")
 */
class ArticleController extends AbstractController
{

    private $manager;

    public function __construct( EntityManagerInterface $manager )
    {
        $this->manager = $manager;
    }


    /**
     * @Route("liste_article", name="article")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('article/index.html.twig', compact("articles"));
    }

    /**
     * @Route("create", name="saveArt")
     */
    public function create(Request $request)
    {

        $article = new Article();

        $form = $this->createForm(FormArticle::class, $article);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){

            try {
                $this->manager->persist($article);
                $this->manager->flush();

                $this->addFlash(
                    "success",
                    "Article \"". $article->getDesignation() ."\" ajouté avec succès"
                );
                return $this->redirectToRoute("article");

            } catch (UniqueConstraintViolationException $u){
                $this->addFlash(
                    "warning",
                    "l'article \"". $article->getDesignation() ."\" éxiste déjà"
                );
            }
        }

        return $this->render("article/form.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("delete/{id_art}", name="delete")
     */
    public function delete($id_art){
        $art = $this->manager->getRepository(Article::class)->find($id_art);

        if( empty($art) ){
            $this->addFlash(
                "warning",
                " Suppression impossible !!"
            );
            return $this->redirectToRoute("article");
        }

        $this->manager->remove($art);
        $this->manager->flush();

        return $this->redirectToRoute("article");
    }

}
