<?php

namespace App\Service;


use App\Entity\User;
use Symfony\Component\Security\Core\Security;

class UtilisateurService
{

    // Avoid calling getUser() in the constructor: auth may not
    // be complete yet. Instead, store the entire Security object.
    public function __construct(
        private Security $security,
    ){
    }

    public function getUtilisateur(): string
    {
        return $this->security->getUser()->getUserIdentifier();
    }

}