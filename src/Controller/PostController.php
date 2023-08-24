<?php

namespace App\Controller;

use App\Dto\post\MakePostDto;
use App\Entity\User;
use App\Mappers\PostMappers;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Cloudinary\Cloudinary;
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
                            )
    {


        $post = PostMappers::postDtoToPost($dto);

        // Configuration de Cloudinary
        $cloudinaryUrl = getenv('CLOUDINARY_URL');
        $cloudinary = new Cloudinary($cloudinaryUrl);


        if($dto->getMedia() !== null) {
            $base64 = explode(',', $dto->getMedia())[1];
            $decodedData = base64_decode($base64);

            // Créer un nom temporaire pour le fichier
            $name = uniqid();
            $tempFilename = sys_get_temp_dir() . '/' . $name;
            file_put_contents($tempFilename, $decodedData);

            if($dto->getTypemedia() === "video"){
                $result = $cloudinary->uploadApi()->upload($tempFilename, [
                    'public_id' => $name,
                    'resource_type' => 'video'
                ]);
            }else{
                // Télécharger le fichier sur Cloudinary
                $result = $cloudinary->uploadApi()->upload($tempFilename, [
                    'public_id' => $name
                ]);
            }


            // Enregistrez l'URL ou l'ID public de l'image téléchargée dans votre base de données
            $post->setMedia($result['public_id']);  // ou $result['secure_url'] si vous souhaitez stocker l'URL complète

            // Supprimer le fichier temporaire
            unlink($tempFilename);
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

        /** @var User $user */
        $user = $this->getUser();
        $branch = $user->getSchoolBranch();

        $posts = $repository->findByPage($page,$limit,$branch);


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
