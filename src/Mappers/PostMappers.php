<?php

namespace App\Mappers;

use App\Dto\post\AffichePosts;
use App\Dto\post\MakePostDto;
use App\Repository\CommentaireRepository;
use App\Entity\Post;
use App\Repository\UserRepository;

class PostMappers
{


    public static function postDtoToPost(MakePostDto $dto) :Post{

        $post = new Post();
        if($dto->getContenu() !== null){
            $post->setContenu($dto->getContenu());
        }

        if($dto->getTypemedia()){
            $post->setTypemedia($dto->getTypemedia());
        }

        return $post;

    }

    //Mapper post to postdto
    public static function postToPostDto(Post $post,
                                        UserRepository $userRepository,
                                        CommentaireRepository $commentaireRepository){

        $postDto = new AffichePosts();
        $postDto->setContenu($post->getContenu());
        $postDto->setMedia($post->getMedia());
        $postDto->setTypemedia($post->getTypemedia());
        $postDto->setId($post->getId());

        //chercher les information nécessaires de l'utlisateur de chaque post:
        $userDePost = $userRepository->find($post->getUser()->getId());
        $postDto->setImageUser($userDePost->getImageProfil());
        $postDto->setNomUser($userDePost->getUsername());


        //Chercher les messages
        $messages = $commentaireRepository->findBy(['post' => $post->getId(), 'active'=> true]);

        $messagesDto = [];

        foreach($messages as $message){
            $messgeDto[] = null;
            $contenu = $message->getContenu();

            //Chercher les infos utilisateur de commentaire:
            $userComImage = $message->getUser()->getImageProfil();
            $userComNom = $message->getUser()->getNom();

            $messgeDto = array("userComImage" => $userComImage,
                "userComNom" => $userComNom, "contenu" => $contenu);
            array_push($messagesDto,$messgeDto);


        }


        $postDto->setCommentaires($messagesDto);



        //$postDto->setCommentaires($post->getCommentaires());
        $postDto->setDateDePost($post->getCreatedAt());
        $postDto->setActive($post->getActive());
        $postDto->setLike($post->getLike());
        $postDto->setDislike($post->getDislike());

        return $postDto;

    }

}