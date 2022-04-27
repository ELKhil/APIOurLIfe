<?php

namespace App\Mappers;

use App\Dto\UserDto;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserMappers
{

    public static function RegisterDTOToUser(
        UserDto                 $dto,
        UserPasswordHasherInterface $hasher): User
    {
        $user = new User();
        $user->setNom($dto->getNom());
        $user->setUsername($dto->getNomUtilisateur());
        $user->setImageProfil($dto->getImageProfil());
        $user->setPassword($hasher->hashPassword($user, $dto->getMdp()));
        $user->setRoles(['ROLE_USER']);
        return $user;
    }

}