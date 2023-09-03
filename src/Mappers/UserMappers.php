<?php

namespace App\Mappers;

use App\Dto\user\AfficheUser;
use App\Dto\user\UserDto;
use App\Entity\User;
use App\Repository\MessageRepository;
use App\Repository\SchollBranchRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserMappers
{

    public static function RegisterDTOToUser(
        UserDto                 $dto,
        UserPasswordHasherInterface $hasher,
        SchollBranchRepository $schollBranchRepository): User
    {
        $user = new User();
        $user->setFirstname($dto->getFirstname());
        $user->setLastname($dto->getLastname());
        $user->setPassword($hasher->hashPassword($user, $dto->getPassword()));
        $user->setRoles(['ROLE_USER']);

        $schoolBranch = $schollBranchRepository->find($dto->getBranch());
        $user->setSchoolBranch($schoolBranch);

        return $user;
    }

    public static function UserToUserDto(User $user)
    {
        $userDto = new AfficheUser();


        $userDto->setId($user->getId());
        $userDto->setEmail($user->getEmail());
        $userDto->setLastname($user->getLastname());
        $userDto->setFirstname($user->getFirstname());
        $userDto->setImageProfil($user->getImageProfil());
        $userDto->setActive($user->getActive());
        $userDto->setBranch($user->getSchoolBranch()->getName());

        return $userDto;
    }

    public static function UserToUserDtoWithMessage(User $user, MessageRepository $messageRepository, $userConnected){
        $userDto = new AfficheUser();

        $userDto->setId($user->getId());
        $userDto->setEmail($user->getEmail());
        $userDto->setLastname($user->getLastname());
        $userDto->setFirstname($user->getFirstname());
        $userDto->setImageProfil($user->getImageProfil());

        $numberOfMessageNonLu = $messageRepository->nombreMessageNonLu($user->getId(),$userConnected->getId());
        $userDto->setUnreadCount($numberOfMessageNonLu);

        $lastMessage = $messageRepository->lastMessage($user->getId());
        $userDto->setLastMessage($lastMessage['content'] ?? '');

        if (isset($lastMessage['createdAt'])) {
            $userDto->setLastMessageDate($lastMessage['createdAt']);
        }

        return $userDto;


    }


}