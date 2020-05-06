<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\form\FormCategorie;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
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

    /**
     * @Route("update/{id_cat}", name="update")
     */
    public function update($id_cat, EntityManagerInterface $manager, Request $request)
    {
        $cat = $manager->getRepository(Categorie::class)->find($id_cat);

        if( empty($cat) ){
            $this->addFlash(
                "warning",
                " Mise à jour not possible !!"
            );
            return $this->redirectToRoute('categorie');
        }

        $form = $this->createForm(FormCategorie::class, $cat);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $manager->flush();
            $this->addFlash(
                "success",
                $cat->getNom() . " est updaté de la base"
            );
            return $this->redirectToRoute('categorie');
        }
        return $this->render('categorie/form.html.twig', ["monFormulaire" => $form->createView()]);
    }

    /**
     * @Route("delete/{id_cat}", name="deleteCat")
     */
    public function delete($id_cat, EntityManagerInterface $manager){
        $cat = $manager->getRepository(Categorie::class)->find($id_cat);

        if( empty($cat) ){
            $this->addFlash(
                "warning",
                " Cat not exists !!"
            );
        }else{
            try {
                $manager->remove($cat);
                $manager->flush();
                $this->addFlash(
                    "success",
                    $cat->getNom() . " supprimé !!"
                );
            }catch (ForeignKeyConstraintViolationException $f){
                $this->addFlash(
                    "warning",
                    "Cette Catégorie est liée à des articles !!"
                );
            }
        }
        return $this->redirectToRoute('categorie');
    }

}
 // CRUD =>  Create Read Update Delete
//  DQL