<?php

namespace App\Controller;

use App\Dto\post\MakePostDto;
use App\Dto\post\PostDto;
use App\Entity\User;
use App\Mappers\PostMappers;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PostController extends AbstractController
{
    #[POST('api/post')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    public function poster(MakePostDto $dto,
                            EntityManagerInterface $em,
                            ParameterBagInterface $parameterBag,
                            UserRepository $userRepository
                            )
    {


        $post = PostMappers::postDtoToPost($dto);

        if($dto->getMedia() !== null) {
            $name = uniqid();
            $base64 = explode(',', $dto->getMedia())[1];
            file_put_contents($parameterBag->get('pictures_directory') . '/' . $name, base64_decode($base64));
            //modifier le média dans le file récupéré
            $post->setMedia($name);
        }

            $post->setActive(true);
            $post->setLike(0);
            $post->setDislike(0);

             /** @var User $user */
            $user = $this->getUser();

            $post->setCreatedAt(new \DateTime());
            $post->setUser($user);

        $em->persist($post);
        $em->flush();
        return $post->getId();
    }

    #[Get('api/posts/{page}/{limit}')]
    #[View]
    public function getAllPost(
                                int $page,
                                int $limit,
                                PostRepository $repository,
                                UserRepository $userRepository,
                                \App\Repository\CommentaireRepository $commentaireRepository)
    {

        //$posts =  $repository->findAll();

        $posts = $repository->findByPage($page,$limit);


        //(array $criteria, array $orderBy = null, $limit = null, $offset = null)

        return array_map(
        //function($item){return ContactMappers::toContactDTO($item);},
            fn($item) => PostMappers::postToPostDto($item,$userRepository,$commentaireRepository),
            $posts
        );
    }

    #[Get('api/post/delet/{postId}')]
    #[View]
    public function delet(int $postId,
                            PostRepository $postRepository,
                            EntityManagerInterface $em){

        $post = $postRepository->find($postId);
        $post->setActive(false);
        $em->flush();
    }

    #[Get('api/posts/{username}')]
    #[View]
    public function getAllPostUser(
        string $username,
        PostRepository $repository,
        UserRepository $userRepository,
        \App\Repository\CommentaireRepository $commentaireRepository)
    {

        //$posts =  $repository->findAll();
        $user = $userRepository->findOneBy(['username' => $username]);
        $posts = $repository->findByPageUser($user->getId());


        //(array $criteria, array $orderBy = null, $limit = null, $offset = null)

        return array_map(
        //function($item){return ContactMappers::toContactDTO($item);},
            fn($item) => PostMappers::postToPostDto($item,$userRepository,$commentaireRepository),
            $posts
        );
    }
}
