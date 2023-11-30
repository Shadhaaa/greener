<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class GenreController extends AbstractController
{
    #[Route('/gender_statistics', name: 'gender_statistics')]
    public function index(UserRepository $userRepository, EntrepriseRepository $entrRepository): Response
    {
        $hommes = $userRepository->countMen()  + $entrRepository->countMen();;

        $femmes = $userRepository->countWomen()  + $entrRepository->countWomen();

        // Render the chart and return the response
        return $this->render('stat/index.html.twig', [
            'hommes' => $hommes,
            'femmes' => $femmes
        ]);
    }
}
