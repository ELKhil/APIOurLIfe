<?php

namespace App\Controller;

use App\Dto\Comment\CommentDto;
use App\Entity\User;
use App\Mappers\ComentMappers;
use App\Repository\CommentaireRepository;
use App\Repository\PostRepository;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class CommentaireController extends AbstractController


{
    #[POST('/api/coment')]
    #[View]
    #[ParamConverter('comentDto', converter: 'fos_rest.request_body')]
    public function post(CommentDto $comentDto,
                         EntityManagerInterface $em,
                         PostRepository $postRepository,
                       )
    {

        $coment = ComentMappers::comentDtoToComent($comentDto, $postRepository);
        $coment->setActive(true);
        $coment->setCreatedAt(new \DateTime());

        /** @var User $user */

        $user = $this->getUser();
        $coment->setUser($user);
        $em->persist($coment);
        $em->flush();

        // Obtenir les informations
        $contenu = $coment->getContenu();
        $userComImage = $coment->getUser()->getImageProfil();
        $userComNom = $coment->getUser()->getFullName();

        // Construire le tableau de données
        $data = [
            'idMessage' => $coment->getId(),
            'contenu' => $contenu,
            'userComImage' => $userComImage,
            'userComNom' => $userComNom,
        ];

        // Renvoyer la réponse au format JSON
        return new Response(json_encode($data), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
    #[Get('api/loadComent/{postId}')]
    #[View]
    public function getMessages(int $postId,
                                EntityManagerInterface $em,
                                CommentaireRepository $commentaireRepository)
    {
        $coments = $commentaireRepository->findBy(['post' => $postId , 'active'=> true ]);

        return array_map(
        //function($item){return ContactMappers::toContactDTO($item);},
            fn($item) => ComentMappers::comentToComentdto($item),
            $coments
        );
    }

        #[Get('api/coment/delet/{messageId}')]
        #[View]
        public function deletMessage(int $messageId,
        CommentaireRepository $commentaireRepository,
        EntityManagerInterface $em){

        $coment= $commentaireRepository->find($messageId);
        $coment->setActive(false);
        $em->flush();

        }

}
