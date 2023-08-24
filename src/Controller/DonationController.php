<?php

namespace App\Controller;

use App\Dto\DonationDto;
use App\Entity\Donation;
use App\Entity\User;
use App\Service\StripeService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class DonationController extends AbstractController
{
    #[Post('api/donation')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    public function index(DonationDto $dto,
                        EntityManagerInterface $em,
                        StripeService $stripeService)
    {

        $donation = new Donation();
        $donation->setAmount($dto->getAmount());
        $donation->setPayement(0);
        $donation->setCreatedAt(new \DateTimeImmutable());

        /** @var User $user */
        $user = $this->getUser();
        $donation->setUser($user);

        $em->persist($donation);
        $em->flush();

        $paymentUrl = $stripeService->startPayment($donation);
        return new JsonResponse(['url' => $paymentUrl]);

    }
}
