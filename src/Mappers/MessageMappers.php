<?php

namespace App\Mappers;



use App\Dto\Message\MessageDto;
use App\Entity\Message;
use App\Repository\UserRepository;

class MessageMappers
{

    public static function messageDtoToMessage(MessageDto $messageDto, UserRepository $userRepository){
        $message = new Message();
        $user = $userRepository->find($messageDto->getSentToId());

        $message->setSentTo($user);
        $message->setContent($messageDto->getContenu());
        $message->setCreatedAt(new \DateTimeImmutable());
        $message->setIsRead(0);

        return $message;
    }




    public static function messageToMessageDto(Message $message){
        $messageDto = new MessageDto();

        $messageDto->setId($message->getId());
        $messageDto->setContenu($message->getContent());
        $messageDto->setCreatedAt($message->getCreatedAt());


        $messageDto->setSentFromId($message->getSentFrom()->getId());
        $messageDto->setSentFromFullName($message->getSentFrom()->getFullName());
        $messageDto->setSentFromImage($message->getSentFrom()->getImageProfil());

        $messageDto->setSentToId($message->getSentTo()->getId());
        $messageDto->setSentToFullName($message->getSentTo()->getFullName());
        $messageDto->setSentToImage($message->getSentTo()->getImageProfil());


        return $messageDto;
    }
}