<?php

namespace App\Controller;

use App\Repository\DonationRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class WebhookController extends AbstractController
{
    private $privateKey;
    private $webhookSecret;

    #[POST('api/webhook')]
    #[View]
    public function index(\Symfony\Component\HttpFoundation\Request $request,
                          LoggerInterface $logger,
                          DonationRepository $repository,
                          EntityManagerInterface $entityManager)
    {

            $this->privateKey = $_ENV['STRIPE_SECRET_KEY_TEST'];
            \Stripe\Stripe::setApiKey($this->privateKey);
            \Stripe\Stripe::setApiVersion('2023-08-16');


        // Check request
        $this->webhookSecret = $_ENV['STRIP_KEY_WEBHOOK'];

        $event = $request->query;
        // Parse the message body and check the signature
        $signature = $request->headers->get('stripe-signature');
        if ($this->webhookSecret) {
            try {
                $event = \Stripe\Webhook::constructEvent(
                    $request->getcontent(),
                    $signature,
                    $this->webhookSecret
                );
            } catch (\Exception $e) {
                return new JsonResponse([['error' => $e->getMessage(),'status'=>403]]);
            }
        }
        $type = $event['type'];

        switch ($type) {
            case 'checkout.session.completed':
                // Payment is successful and the subscription is created.
                // You should provision the subscription.
                $metadata = $event['data']['object']['metadata'];
                $cartId = $metadata['cart_id'];

                if($cartId){
                    $donation= $repository->find($cartId);
                    $donation->setPayement(1);
                    $entityManager->persist($donation);
                    $entityManager->flush();
                }
                break;
            case 'invoice.paid':
                // Continue to provision the subscription as payments continue to be made.
                // Store the status in your database and check when a user accesses your service.
                // This approach helps you avoid hitting rate limits.
                break;
            case 'invoice.payment_failed':
                // The payment failed or the customer does not have a valid payment method.
                // The subscription becomes past_due. Notify your customer and send them to the
                // customer portal to update their payment information.
                break;
            // ... handle other event types
            default:
                // Unhandled event type
        }

        return new JsonResponse([['status'=>200]]);

    }
}