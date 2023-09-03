<?php

namespace App\Controller;

use App\Entity\User;
use App\Mappers\MessageMappers;
use App\Repository\MessageRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MessageController extends AbstractController
{
    #[Get('api/messages/{id}')]
    #[View]
    public function getAllMessages(string $id,
                                           MessageRepository $messageRepository){

        /** @var User $user */
        $user = $this->getUser();
        $allMessages =  $messageRepository->getAllMessages($user->getId(), $id);


        return array_map(
            fn($item) => MessageMappers::messageToMessageDto($item),
            $allMessages
        );
    }
}
