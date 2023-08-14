<?php

namespace App\Controller;


use App\Mappers\BranchMappers;
use App\Mappers\UserMappers;
use App\Repository\SchollBranchRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SchoolBranchController extends AbstractController
{
    #[Get('api/schoolBranch')]
    #[View]
    public function getAllBranch(
                            SchollBranchRepository $schollBranchRepository
                                )
    {
        $branches = $schollBranchRepository->findAll();

        return array_map(
            fn($item) => BranchMappers::branchToBranchDto($item),
            $branches
        );

    }
}
