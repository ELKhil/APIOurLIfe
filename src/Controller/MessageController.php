<?php

namespace App\Controller;

use App\Dto\Message\MessageDto;
use App\Entity\User;
use App\Mappers\MessageMappers;
use App\Mappers\PostMappers;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MessageController extends AbstractController
{
    #[POST('api/message')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    public function posterMessage(EntityManagerInterface $em,
                                  MessageRepository $messageRepository,
                                  MessageDto $dto,
                                  UserRepository $userRepository){


        $message = MessageMappers::messageDtoToMessage($dto, $userRepository);

        /** @var User $user */
        $user = $this->getUser();
        $message->setSentFrom($user);
        $em->persist($message);
        $em->flush();
    }

    #[Get('api/messages/{id}')]
    #[View]
    public function getAllMessages(string $id,
                                   MessageRepository $messageRepository,
                                    EntityManagerInterface $em){

        /** @var User $user */
        $user = $this->getUser();
        //Get
        $allMessages =  $messageRepository->getAllMessages($user->getId(), $id);
        $readCount = 0;

        foreach ($allMessages as $message){
            if($message->getSentTo()->getId() == $user->getId()  && $message->isIsRead() == 0){
                $message->setIsRead(1);
                $em->persist($message);
                $readCount++;
            }
        }

        $em->flush();


        $messagesDto = array_map(
            fn($item) => MessageMappers::messageToMessageDto($item),
            $allMessages
        );

        return [
            'messages' => $messagesDto,
            'readCount' => $readCount
        ];
    }
}
