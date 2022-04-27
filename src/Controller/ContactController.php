<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractFOSRestController
{
    #[Get('/api/contacts')]
    #[View]
    #[IsGranted('ROLE_USER')]
    public function getByUser(ContactRepository $contactRepository) {
        $contacts
            = $contactRepository->findBy(['user' => $this->getUser()]);

        return array_map(
        //function($item){return ContactMappers::toContactDTO($item);},
            fn($item) => ContactMappers::toContactDTO($item),
            $contacts
        );
    }
}
