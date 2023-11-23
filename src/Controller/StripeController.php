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
    #[Route('/stripe/payment-success/{sessionId}', name: 'stripe_payment_success')]
    public function success(string $sessionId): Response
    {
        // Ajoutez ici le code nécessaire pour la page de succès
        return $this->render('stripe/success.html.twig', ['sessionId' => $sessionId]);
    }

    #[Route('/stripe/payment-cancel/{sessionId}', name: 'stripe_payment_cancel')]
    public function cancel(string $sessionId): Response
    {
        // Ajoutez ici le code nécessaire pour la page d'annulation
        return $this->render('stripe/cancel.html.twig', ['sessionId' => $sessionId]);
    }
}