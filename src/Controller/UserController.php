<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Entity\User;
use App\Mappers\UserMappers;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserController extends AbstractFOSRestController
{
    #[POST('/api/user')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    public function post(   UserDto $dto,
                             UserPasswordHasherInterface $hasher,
                            EntityManagerInterface $em)
    {
        // transform DTO in entity(mapping)

        $user = UserMappers::RegisterDTOToUser($dto,$hasher);
        var_dump($user);
        $em->persist($user);
        $em->flush();
        return $user->getId();
    }
}
