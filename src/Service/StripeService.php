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
            $this->privateKey = $_ENV['STRIPE_SECRET_KEY_TEST'];
            \Stripe\Stripe::setApiKey($this->privateKey);
            \Stripe\Stripe::setApiVersion('2023-08-16');
    }


    public function startPayment(Donation $donation){

        $donationId = $donation->getId();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => "Soutenir le projet OurLife",
                        ],
                        'unit_amount' => $donation->getAmount() * 100,
                    ],
                ],
            ],
            'metadata' => [
                'cart_id' => $donationId,
            ],
            'mode' => 'payment',

            'success_url' => 'https://ourlife-icc-db0d6fc90c55.herokuapp.com/success',
            'cancel_url' => 'https://ourlife-icc-db0d6fc90c55.herokuapp.com/soutenir',
        ]);


        //il faut faire une redirection
       // return new RedirectResponse($session->url);
        return $session->url;
    }


}