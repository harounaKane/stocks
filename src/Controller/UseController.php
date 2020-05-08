<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UseController
 * @package App\Controller
 * @Route("/user")
 */
class UseController extends AbstractController
{
    /**
     * @Route("/user_connexion", name="connexion_user")
     */
    public function connexion(Request $request, UserRepository $repo){
        $form = $this->createFormBuilder()
            ->add("login")
            ->add("mdp", PasswordType::class)
            ->add("submit", SubmitType::class, ['label' => "connexion"])
            ->getForm()
        ;

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $data = $form->getData();

            $user = $repo->connexionUser($data['login']);

            if( $user ){
                if( password_verify($data['mdp'], $user->getMdp()) ){
                    $session = $request->getSession();
                    $session->set("prenom", $user->getPrenom());

                    return $this->redirectToRoute("home");
                }
            }
        }

        return $this->render("user/connexion.html.twig", ['form' => $form->createView()]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion_user")
     */
    public function deconnexion(){
        $this->get('session')->clear();

        return $this->redirectToRoute("connexion_user");
    }

}