<?php

namespace App\EventListener;



use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;


class JWTCratedListener

{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository= $userRepository;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event,

    )
    {

        $data = $event->getUser()->getUserIdentifier();
        $userRepo = $this->userRepository->findOneBy(['email'=>$data]);

        // Si le champ 'active' de l'utilisateur est false, on lance une exception.
        if (!$userRepo->getActive()) {
            throw new CustomUserMessageAuthenticationException('Votre compte n\'est pas actif.');
        }
//        dump($userRepo);
        $payload['email']= $event->getUser()->getUserIdentifier();
        $payload['id'] = $userRepo->getId();
        $payload['role'] = $event->getUser()->getRoles();
        $payload['imageProfil'] = $userRepo->getImageProfil();
        $payload['fullName'] = $userRepo->getFullName();
        $payload['stars'] = $userRepo->getStars();
        $payload['branch'] = $userRepo->getSchoolBranch()->getName();
        $payload['anacad'] = $userRepo->getSchoolBranch()->getAnacad();

        $event->setData($payload);

    }


}