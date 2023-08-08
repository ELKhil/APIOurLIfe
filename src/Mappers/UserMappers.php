<?php

namespace App\Mappers;

use App\Dto\user\AfficheUser;
use App\Dto\user\UserDto;
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
        $user->setPassword($hasher->hashPassword($user, $dto->getMdp()));
        $user->setRoles(['ROLE_USER']);

        return $user;
    }

    public static function UserToUserDto(User $user)
    {
        $userDto = new AfficheUser();

        $userDto->setNomUtilisateur($user->getUsername());
        $userDto->setNom($user->getNom());
        $userDto->setImageProfil($user->getImageProfil());
        $userDto->setActive($user->getActive());

        return $userDto;
    }



}