<?php

namespace App\Mappers;


use App\Dto\DonationDto;
use App\Entity\Donation;
use App\Entity\User;


class DonationMappers
{
    public static function donationTodonationDto(Donation $donation, User $user){
        $donatioDto = new DonationDto();

        $donatioDto->setId($donation->getId());
        $donatioDto->setAmount($donation->getAmount());
        $donatioDto->setCreatedAt($donation->getCreatedAt());


        if($donation->getUser()->getId() !== $user->getId()){
            $donatioDto->setName("xxxxx-xxxxx");
        }else{
            $donatioDto->setName($donation->getUser()->getFullName());
        }



        return $donatioDto;
    }

}