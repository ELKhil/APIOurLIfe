<?php

namespace App\Dto;

class UserDto
{
        private string $nom;
        private string $nomUtilisateur;
        private string $mdp;
        private string $imageProfil;


    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return UserDto
     */
    public function setNom(string $nom): UserDto
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomUtilisateur(): string
    {
        return $this->nomUtilisateur;
    }

    /**
     * @param string $nomUtilisateur
     * @return UserDto
     */
    public function setNomUtilisateur(string $nomUtilisateur): UserDto
    {
        $this->nomUtilisateur = $nomUtilisateur;
        return $this;
    }

    /**
     * @return string
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * @param string $mdp
     * @return UserDto
     */
    public function setMdp(string $mdp): UserDto
    {
        $this->mdp = $mdp;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageProfil(): string
    {
        return $this->imageProfil;
    }

    /**
     * @param string $imageProfil
     * @return UserDto
     */
    public function setImageProfil(string $imageProfil): UserDto
    {
        $this->imageProfil = $imageProfil;
        return $this;
    }




}