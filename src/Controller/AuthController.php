<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Form\User1Type;


class AuthController extends AbstractController
{
    private $passwordHasher;
    private $tokenStorage;
    private $mailer;

    public function __construct(UserPasswordHasherInterface $passwordHasher, TokenStorageInterface $tokenStorage, MailerInterface $mailer)
    {
        $this->passwordHasher = $passwordHasher;
        $this->tokenStorage = $tokenStorage;
        $this->mailer = $mailer;
    }

    #[Route('/auth', name: 'app_auth')]
    public function index(): Response
    {
        return $this->render('auth/index.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }


    #[Route('/register', name: 'app_auth_register',  methods: ['GET', 'POST'])]
    public function register(MailerInterface $mailer, Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, UserRepository $userrepo): Response
    {
        //recupere

        $user = new User();

        if ($request->isMethod('POST')) {
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $num = $request->request->get('num');
            $genre = $request->request->get('genre');
            $adresse = $request->request->get('adresse');
            $role = $request->request->get('role');
            $mail = $request->request->get('mail');
            $password = $request->request->get('pass');
            //ajouter au user
            $user->setNom($nom);
            $user->setprenom($prenom);
            $user->setnum($num);
            $user->setgenre($genre);
            $user->setadresse($adresse);
            $user->setrole($role);
            $user->setmail($mail);
            $user->setMdp1($this->passwordHasher->hashPassword($user, $password));
            //set id
            $query = $userrepo->createQueryBuilder('a')
                ->select('MAX(a.idUser) as max')
                ->getQuery();
            $result = $query->getSingleScalarResult();
            $result  = $result + 1;
            $user->setIdUser($result);


            if ($user != null) {
                //securiser mdp
                $entityManager->persist($user);
                $entityManager->flush();
                //send email 
                $email = (new Email())
                    ->from('hello@example.com')
                    ->to('you@example.com')
                    ->subject('Time for Symfony Mailer!')
                    ->text('Sending emails is fun again!')
                    ->html('<p>See Twig integration for better HTML integration!</p>');

                $mailer->send($email);
                //selon role *************
                return $this->redirectToRoute('app_user_profile', [
                    'idUser' => $user->getIdUser()
                ]);
            }
        }
        return $this->renderForm('Front/user/cree.html.twig');
    }

    // Répondre avec une réponse JSON
    /*return $this->json(['message' => 'User registered successfully'], Response::HTTP_CREATED);
    }*/
    /*
    #[Route('/login', name: 'app_auth_login')]
    public function login(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher, JWTTokenManagerInterface $JWTManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Rechercher l'utilisateur par adresse e-mail
        $user = $userRepository->findOneBy(['email' => $data['email']]);

        if (!$user || !$passwordHasher->isPasswordValid($user, $data['password'])) {
            throw new BadCredentialsException('Invalid credentials');
        }

        // Générer le jeton JWT
        $token = $JWTManager->create($user);

        return $this->json(['token' => $token], Response::HTTP_OK);
    }*/

    #[Route('/reset_pass', name: 'reset_password')]
    public function resetPassword(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, JWTTokenManagerInterface $JWTManager): JsonResponse
    {
        /* $data = json_decode($request->getContent(), true);

        // Rechercher l'utilisateur par adresse e-mail
        $user = $userRepository->findOneBy(['email' => $data['email']]);

        if (!$user) {
            throw new BadCredentialsException('Invalid email address');
        }

        // Générer un jeton de réinitialisation de mot de passe unique
        $resetToken = $JWTManager->create($user);

        // Stocker le jeton de réinitialisation dans l'entité User
        $user->setInvestisseurInv($resetToken);
        $entityManager->persist($user);
        $entityManager->flush();

        // Envoyer l'e-mail de réinitialisation du mot de passe
        $email = (new TemplatedEmail())
            ->from(new Address('noreply@example.com', 'My App'))
            ->to($user->getmail())
            ->subject('Reset Password')
            ->htmlTemplate('auth/reset_password.html.twig')
            ->context([
                'resetToken' => $resetToken,
            ]);

        $this->mailer->send($email);*/

        return $this->json(['message' => 'Password reset email sent'], Response::HTTP_OK);
    }
}
