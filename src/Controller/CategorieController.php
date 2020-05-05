<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\form\FormCategorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/categorie/")
 */
class CategorieController extends AbstractController
{
    /**
     * @Route("new_categorie", name="categorie")
     */
    public function index(EntityManagerInterface $manager)
    {
        $categories = $manager->getRepository(Categorie::class)->findAll();

        return $this->render('categorie/index.html.twig', compact("categories"));
    }

    /**
     * @Route("creer", name="saveCat")
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $categorie = new Categorie();

        $form = $this->createForm(FormCategorie::class, $categorie);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('categorie');
        }

        return $this->render('categorie/form.html.twig', ["monFormulaire" => $form->createView()]);
    }
}
/*
 * $cat = new Categorie();

        $data = $request->request->all();

        if( $this->isCsrfTokenValid("toto", $data['_token']) ){
            $cat->setNom( $data['nom'] );
            $cat->setDescription( $data['description'] );

            $manager->persist($cat);
            $manager->flush();
        }
 */