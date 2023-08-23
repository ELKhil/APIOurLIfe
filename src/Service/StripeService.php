<?php

namespace App\Service;

use App\Entity\Donation;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StripeService
{
    private $privateKey;

    public function __construct()
    {
        if($_ENV['APP_ENV'] === 'prod'){
            $this->privateKey = $_ENV['STRIPE_SECRET_KEY_TEST'];
            \Stripe\Stripe::setApiKey($this->privateKey);
            \Stripe\Stripe::setApiVersion('2022-11-15');
        }
        /*else{
            $this->privateKey = $_ENV['STRIPE_SECRET_KEY_LIVE'];
        }*/
    }

    public function startPayment(Donation $donation){

        $donationId = $donation->getId();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => "Soutenir le projet OurLife",
                        ],
                        'unit_amount' => $donation->getAmount(),
                    ],
                ],
            ],
            'metadata' => [
                'cart_id' => $donationId,
            ],
            'mode' => 'payment',

            'success_url' => $_ENV['SITE_URL'].'/success',
            'cancel_url' => $_ENV['SITE_URL'].'/soutenir',
        ]);

        //il faut faire une redirection
        return new RedirectResponse($session->url);
    }


}