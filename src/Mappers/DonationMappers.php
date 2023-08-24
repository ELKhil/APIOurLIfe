<?php

namespace App\Mappers;


use App\Dto\DonationDto;
use App\Entity\Donation;


class DonationMappers
{
    public static function donationTodonationDto(Donation $donation){
        $donatioDto = new DonationDto();

        $donatioDto->setId($donation->getId());
        $donatioDto->setAmount($donation->getAmount());
        $donatioDto->setCreatedAt($donation->getCreatedAt());
        $donatioDto->setName($donation->getUser()->getFullName());


        return $donatioDto;
    }

}