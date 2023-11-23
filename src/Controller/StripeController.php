<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Services\StripePaymentService ;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    #[Route('/stripe/checkout/{commandeId}', name: 'stripe_checkout')]
    public function checkout(Commande $commande,StripePaymentService $stripePaymentService ): Response
    {
        // Utilisez votre service de paiement Stripe pour créer une session de paiement
        $stripeSessionId = $stripePaymentService->createCheckoutSession($commande);

        // Vous pouvez également passer d'autres informations nécessaires à votre vue
        return $this->render('stripe/index.html.twig', [
            'stripeSessionId' => $stripeSessionId,
            'commande' => $commande,
        ]);
    }
}