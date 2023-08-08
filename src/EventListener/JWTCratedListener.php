<?php

namespace App\EventListener;



use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;


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
        $userRepo = $this->userRepository->findOneBy(['username'=>$data]);
//        dump($userRepo);
        $payload['username']= $event->getUser()->getUserIdentifier();
        $payload['id'] = $userRepo->getId();
        $payload['role'] = $event->getUser()->getRoles();
        $payload['imageProfil'] = $userRepo->getImageProfil();

        $event->setData($payload);

    }


}