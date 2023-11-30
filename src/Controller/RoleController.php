<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends AbstractController
{

    #[Route('/role_counts', name: 'role_counts', methods: ['GET'])]
    public function roleCounts(UserRepository $userRepository, EntrepriseRepository $entrprise): Response
    {
        // Get the count of clients
        $numberOfClients = $userRepository->countByRole('client');

        // Get the count of investors
        $numberOfInvestors = $userRepository->countByRole('investisseur');

        // Get the count of company agents
        $numberOfCompanyAgents = $entrprise->countByRole('agent_entreprise');

        // Render the chart view with the counts
        return $this->render('Back/user/role_counts.html.twig', [
            'numberOfClients' => $numberOfClients,
            'numberOfInvestors' => $numberOfInvestors,
            'numberOfCompanyAgents' => $numberOfCompanyAgents
        ]);
    }
}
