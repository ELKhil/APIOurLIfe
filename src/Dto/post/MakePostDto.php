<?php

namespace App\Dto\post;

class MakePostDto
{

    private ?string $media;
    private ?string $typemedia;
    private string $contenu;
    private int $userID;

    /**
     * @return string|null
     */
    public function getMedia(): ?string
    {
        return $this->media;
    }

    /**
     * @param string|null $media
     * @return MakePostDto
     */
    public function setMedia(?string $media): MakePostDto
    {
        $this->media = $media;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypemedia(): ?string
    {
        return $this->typemedia;
    }

    /**
     * @param string|null $typemedia
     * @return MakePostDto
     */
    public function setTypemedia(?string $typemedia): MakePostDto
    {
        $this->typemedia = $typemedia;
        return $this;
    }



    /**
     * @return string
     */
    public function getContenu(): string
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     * @return MakePostDto
     */
    public function setContenu(string $contenu): MakePostDto
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     * @return MakePostDto
     */
    public function setUserID(int $userID): MakePostDto
    {
        $this->userID = $userID;
        return $this;
    }



}