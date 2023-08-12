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
        $user->setFirstname($dto->getFirstname());
        $user->setLastname($dto->getLastname());
        $user->setEmail($dto->getEmail());
        $user->setPassword($hasher->hashPassword($user, $dto->getPassword()));
        $user->setRoles(['ROLE_USER']);

        return $user;
    }

    public static function UserToUserDto(User $user)
    {
        $userDto = new AfficheUser();

        $userDto->setEmail($user->getEmail());
        $userDto->setLastname($user->getLastname());
        $userDto->setFirstname($user->getFirstname());
        $userDto->setImageProfil($user->getImageProfil());
        $userDto->setActive($user->getActive());

        return $userDto;
    }



}