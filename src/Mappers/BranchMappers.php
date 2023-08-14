<?php

namespace App\Mappers;



use App\Dto\Branch\BranchDTO;
use App\Entity\SchollBranch;

class BranchMappers

{

    public static function branchDtoToBranch(BranchDTO $branchDto,
                                             ){

        $branch= new SchollBranch();

        $branch->setName($branchDto->getName());
        $branch->setAnacad($branchDto->getAnacad());



        return $branch;
    }

    public static function branchToBranchDto(SchollBranch $schollBranch){
        $branchDto = new BranchDTO();

        $branchDto->setId($schollBranch->getId());
        $branchDto->setName($schollBranch->getName());
        $branchDto->setAnacad($schollBranch->getAnacad());

        return $branchDto;
    }
}