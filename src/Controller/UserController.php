<?php

namespace App\Controller;

use App\Dto\user\UserDto;
use App\Mappers\UserMappers;
use App\Repository\CommentaireRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserController extends AbstractFOSRestController
{
    #[POST('api/user')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    public function post(   UserDto $dto,
                            UserPasswordHasherInterface $hasher,
                            EntityManagerInterface $em,
                            ParameterBagInterface $parameterBag,
                            LoggerInterface $logger)
    {
        // transform DTO in entity(mapping)
        $user = UserMappers::RegisterDTOToUser($dto,$hasher);


        if($dto->getImageProfil() !== null){
            $name = uniqid();
            $base64 = explode(',',$dto->getImageProfil())[1];
            $logger->info('Pictures directory: ' . $parameterBag->get('pictures_directory'));
            file_put_contents($parameterBag->get('pictures_directory').'/'.$name,base64_decode($base64));
            $user->setImageProfil($name);
            $user->setActive(true);
        }
        $em->persist($user);
        $em->flush();
        return $user->getId();
    }

        #[Get('api/users')]
        #[View]
        public function getALLUsers(UserRepository $userRepository){
            $users = $userRepository->findAllUsersActif();

            return array_map(
                fn($item) => UserMappers::UserToUserDto($item),
                $users
            );
        }

    #[Get('api/user/delet/{username}')]
    #[View]
    public function delet(string $username,
                          UserRepository $userRepository,
                          PostRepository $postRepository,
                          CommentaireRepository $commentaireRepository,
                          EntityManagerInterface $em){

       //update active user
       $user= $userRepository->findOneBy(['username' => $username]);
       $user->setActive(false);
       $em->flush();

       //update active posts
       $posts = $postRepository->findBy(['user' => $user->getId()]);
          foreach($posts as $post){
              $post->setActive(false);
              $em->flush();
          }

       $coments = $commentaireRepository->findBy(['user' => $user->getId()]);
          foreach ($coments as $coment){
              $coment->setActive(false);
              $em->flush();
          }


    }




}
