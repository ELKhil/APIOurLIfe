<?php

namespace App\Mappers;

use App\Dto\Comment\CommentDto;
use App\Entity\Commentaire;
use App\Repository\PostRepository;

class ComentMappers
{
    public static function comentDtoToComent(CommentDto $comentDto,
                                            PostRepository $postRepository){

        $coment = new Commentaire();

        $coment->setContenu($comentDto->getContenu());
        $postComent = $postRepository->find($comentDto->getPostId());

        $coment->setPost($postComent);
        return $coment;
    }

    public static function comentToComentdto(Commentaire $coment){
        $comentDto = new CommentDto();

        $comentDto->setIdMessage($coment->getId());
        $comentDto->setActive((bool)$coment->getActive());
        $comentDto->setContenu($coment->getContenu());
        $comentDto->setPostId($coment->getPost()->getId());
        $comentDto->setUserComImage($coment->getUser()->getImageProfil());
        $comentDto->setUserComNom($coment->getUser()->getFullName());
        $comentDto->setDateMessage($coment->getCreatedAt());
        return $comentDto;
    }
}