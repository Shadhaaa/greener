<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Entreprise;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Form\User1Type;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


#[Route('/user')]
class UserController extends AbstractController
{

    #[Route('/auth', name: 'app_auth')]
    public function auth(): Response
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");

        /** @var User $user */
        $user = $this->getUser();

        return match ($user->isVerified()) {
            true => $this->render("back/user/index.html.twig"),
            false => $this->render("admin/verify.html.twig"),
        };
    }
    #[Route('/contact', name: 'app_user_contact', methods: ['GET'])]
    public function contact(): Response
    {
        return $this->render('Back/AdminHome.html.twig');
    }

    #[Route('/cnx1', name: 'app_user_cnx1')]
    public function Cnx1(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('Front/CnxUser1.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    #[Route('/cnx', name: 'app_user_cnx')]
    public function Cnx(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $user = new User();
        if ($request->isMethod('POST')) {
            $email = $request->request->get('username');
            $password = $request->request->get('password');

            if ($email === "admin" && $password === "admin") {
                return $this->redirectToRoute('app_user_index');
            }
            // Recherche parmi les user
            $user = $entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy(['mail' => $email]);


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
            } elseif ($user instanceof Entreprise) {
                // L'entreprise existe et a été trouvée par son adresse e-mail
                if (password_verify($password, $user->getMdp1())) {
                    // Le mot de passe correspond, redirection en fonction du rôle
                    return $this->redirectToRoute('app_entreprise_profile', ['id' => $user->getidentreprise()]);
                } else {
                    // Mot de passe incorrect
                    $this->addFlash('error', 'Mot de passe incorrect.');
                    return $this->redirectToRoute('app_user_cnx');
                }
            } else {
                // Pas d'e-mail trouvé
                $this->addFlash('error', 'Pas d\'e-mail trouvé.');
                return $this->redirectToRoute('app_user_cnx');
            }
        }
        return $this->renderForm('Front/CnxUser.html.twig');
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
            ->select('MAX(a.id) as max')
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
    public function edit(UserPasswordHasherInterface $passwordHasher, Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);
        $formData = $form->getData();

        $password = $formData->getMdp1();

        $user->setMdp1($passwordHasher->hashPassword($user, $password));


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

    //home client
    #[Route('/profile/{idUser}', name: 'app_user_profile', methods: ['GET'])]
    public function profile(User $user): Response
    {
        return $this->render('Front/user/UserHome.html.twig', [
            'user' => $user,
        ]);
    }
    //edit profile
    #[Route('/{idUser}/Meedit', name: 'app_user_Meedit', methods: ['GET', 'POST'])]
    public function Meedit(UserPasswordHasherInterface $passwordHasher, Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);
        $formData = $form->getData();

        $password = $formData->getMdp1();

        $user->setMdp1($passwordHasher->hashPassword($user, $password));



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
