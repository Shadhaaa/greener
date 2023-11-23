<?php

namespace App\Services;

use App\Entity\Commande;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripePaymentService
{
    private $publicKey;
    private $secretKey;

public function __construct()
    {
        $this->publicKey = 'pk_test_51O4X5XCZicFmO9OlJS5yjZ9LhBEOAKt28ROnDYVTz1fnJkUkyORJe7Uzmtl0Xo1ttv0dJIVduvoQ5zlAqyxLP5Rp00yBcHabL2';
        $this->secretKey = 'sk_test_51O4X5XCZicFmO9OlQe9jkt0X8JF0xPTV2zzNSCWDbl4uUMOPeQIjPbw2HGR9vO19nszhq47MUrxRexNtQNQTiu4900NQpdYyUm';

        // Configurez la clé secrète de Stripe
        Stripe::setApiKey($this->secretKey);
    }

    public function createCheckoutSession(Commande $commande): string
    {
        // Créez une session de paiement avec Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Commande #' . $commande->getCommandeId(),
                        ],
                        'unit_amount' => $commande->getMontantTotal() * 100, // Convertir le montant en centimes
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/stripe/payment-success/{CHECKOUT_SESSION_ID}', // Remplacez par l'URL de succès de votre choix
            'cancel_url' => 'http://localhost:8000/stripe/payment-cancel/{CHECKOUT_SESSION_ID}', // Remplacez par l'URL d'annulation de votre choix
        ]);

        return $session->id;
    }

    public function getPaymentDetails(string $stripeSessionId)
    {
        // Obtenez les détails de paiement avec Stripe
        $session = Session::retrieve($stripeSessionId);

        // Vous pouvez maintenant traiter les détails du paiement comme nécessaire
        return $session->payment_intent;
    }
}
