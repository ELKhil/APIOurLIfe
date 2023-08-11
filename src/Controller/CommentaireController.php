<?php

namespace App\Controller;

use App\Dto\Comment\CommentDto;
use App\Entity\User;
use App\Mappers\ComentMappers;
use App\Repository\CommentaireRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;


class CommentaireController extends AbstractController
{
    #[POST('/api/coment')]
    #[View]
    #[ParamConverter('comentDto', converter: 'fos_rest.request_body')]
    public function post(CommentDto $comentDto,
                         EntityManagerInterface $em,
                         PostRepository $postRepository,
                         Security $security)
    {

        $coment = ComentMappers::comentDtoToComent($comentDto, $postRepository);
        $coment->setActive(true);
        $coment->setCreatedAt(new \DateTime());

        /** @var User $user */
        $user = $security->getUser();
        //$user= $this->getUser();
        $coment->setUser($user);
        $em->persist($coment);
        $em->flush();
        return $coment->getId();
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
