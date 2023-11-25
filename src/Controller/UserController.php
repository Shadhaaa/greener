<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Entreprise;

use App\Form\User1Type;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


#[Route('/user')]
class UserController extends AbstractController
{

    #[Route('/contact', name: 'app_user_contact', methods: ['GET'])]
    public function contact(): Response
    {
        return $this->render('Back/AdminHome.html.twig');
    }


    //cree compte 
    #[Route('/cree_compte', name: 'app_user_cree', methods: ['GET'])]
    public function cree(): Response
    {
        return $this->render('Front/user/cree.html.twig');
    }

    //connexion
    #[ParamConverter("user")]

    #[Route('/cnx', name: 'app_user_cnx', methods: ['GET'])]
    public function Cnx(Request $request, EntityManagerInterface $entityManager)
    {


        $email = $request->request->get('email');
        $password = $request->request->get('password');
        if ($email == "admin" && $password == "admin") {
            return $this->redirectToRoute('app_user_invprofile', ['id' => 140]);
        }


        return $this->render('Front/CnxUser.html.twig');


        //return $this->redirectToRoute('app_user_profile', ['id' => 134]);


        // return $this->redirectToRoute('app_user_invprofile', ['id' => 140]);
        // return $this->redirectToRoute('app_entreprise_profile', ['id' => 9]);

        /* $email = $request->request->get('email');
        $password = $request->request->get('password');

        // Recherche parmi les utilisateurs
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['mail' => $email]);

        if ($email === 'admin' && $password === 'admin') {
            // Redirection vers la page user_index pour le rôle admin
            return $this->redirectToRoute('app_user_profile', ['id' => $user->getIdUser()]);
        }
        return $this->render('Front/CnxUser.html.twig');

        
       

        // Recherche parmi les entreprises
        $entrepriseRepository = $entityManager->getRepository(Entreprise::class);
        $entreprise = $entrepriseRepository->findOneBy(['mail' => $email]);

        if ($user instanceof User) {
            // L'utilisateur existe et a été trouvé par son adresse e-mail
            if (password_verify($password, $user->getMdp1())) {
                // Le mot de passe correspond, redirection en fonction du rôle
                if ($user->getRole() === 'CLIENT') {
                    // Redirection vers l'interface Clienthome
                    return $this->redirectToRoute('app_user_profile', ['id' => $user->getIdUser()]);
                } elseif ($user->getRole() === 'INVESTISSEUR') {
                    // Redirection vers l'interface Invhome
                    return $this->redirectToRoute('app_user_invprofile', ['id' => $user->getIdUser()]);
                }
            } else {
                // Mot de passe incorrect
                $this->addFlash('error', 'Mot de passe incorrect.');
                return $this->redirectToRoute('app_user_cnx');
            }
        } elseif ($entreprise instanceof Entreprise) {
            // L'entreprise existe et a été trouvée par son adresse e-mail
            if (password_verify($password, $entreprise->getMdp1())) {
                // Le mot de passe correspond, redirection en fonction du rôle
                return $this->redirectToRoute('app_entreprise_profile', ['id' => $user->getIdUser()]);
            } else {
                // Mot de passe incorrect
                $this->addFlash('error', 'Mot de passe incorrect.');
                return $this->redirectToRoute('app_user_cnx');
            }
        } else {
            // Pas d'e-mail trouvé
            $this->addFlash('error', 'Pas d\'e-mail trouvé.');
            return $this->redirectToRoute('app_user_cnx');
        }*/
    }

    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('Back/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $userrepo): Response
    {
        $user = new User();
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);
        $query = $userrepo->createQueryBuilder('a')
            ->select('MAX(a.idUser) as max')
            ->getQuery();
        $result = $query->getSingleScalarResult();

        $result  = $result + 1;
        $user->setIdUser($result);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }



    #[Route('/{idUser}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('Back/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{idUser}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{idUser}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getIdUser(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
    //front user 

    #[Route('/profile/{idUser}', name: 'app_user_profile', methods: ['GET'])]
    public function profile(User $user): Response
    {
        return $this->render('Front/user/UserHome.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{idUser}/Meedit', name: 'app_user_Meedit', methods: ['GET', 'POST'])]
    public function Meedit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_profile', [
                'idUser' => $user->getIdUser()
            ]);
        }

        return $this->renderForm('Front/user/Meedit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    //front inv
    #[Route('/profileinv/{idUser}', name: 'app_user_invprofile', methods: ['GET'])]
    public function profileinv(User $user): Response
    {
        return $this->render('Front/user/invHome.html.twig', [
            'user' => $user,
        ]);
    }
}
