<?php

namespace App\Controller;

use App\Entity\Donation;
use App\Service\StripeService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DonationController extends AbstractController
{
    #[Post('api/donation/{amount}')]
    #[View]
    public function index($amount,
                        EntityManagerInterface $em,
                        StripeService $stripeService)
    {
        $donation = new Donation();
        $donation->setAmount($amount);
        $donation->setPayement(false);

        $em->persist($donation);
        $em->flush();

        return $stripeService->startPayment($donation);
    }
}
