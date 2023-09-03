<?php

namespace App\Mappers;



use App\Dto\Message\MessageDto;
use App\Entity\Message;

class MessageMappers
{
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