<?php

namespace App\Dto\user;

class AfficheUser
{
    private string $nom;
    private string $imageProfil;
    private string $nomUtilisateur;
    private bool $active;

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return AfficheUser
     */
    public function setActive(bool $active): AfficheUser
    {
        $this->active = $active;
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
     * @return AfficheUser
     */
    public function setNomUtilisateur(string $nomUtilisateur): AfficheUser
    {
        $this->nomUtilisateur = $nomUtilisateur;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return AfficheUser
     */
    public function setNom(string $nom): AfficheUser
    {
        $this->nom = $nom;
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
     * @return AfficheUser
     */
    public function setImageProfil(string $imageProfil): AfficheUser
    {
        $this->imageProfil = $imageProfil;
        return $this;
    }


}