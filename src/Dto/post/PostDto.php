<?php

namespace App\Dto\post;

class PostDto
{

    private ?string $media;
    private string $contenu;
    private ?string $typemedia;
    private int $userID;
    private int $id;
    //private User $user;
    private array $commentaires = [];
    private \DateTime $dateDePost;
    private bool $active;
    private int $like;
    private int $dislike;

    /**
     * @return int
     */
    public function getLike(): int
    {
        return $this->like;
    }

    /**
     * @param int $like
     * @return PostDto
     */
    public function setLike(int $like): PostDto
    {
        $this->like = $like;
        return $this;
    }

    /**
     * @return int
     */
    public function getDislike(): int
    {
        return $this->dislike;
    }

    /**
     * @param int $dislike
     * @return PostDto
     */
    public function setDislike(int $dislike): PostDto
    {
        $this->dislike = $dislike;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return PostDto
     */
    public function setActive(bool $active): PostDto
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateDePost(): \DateTime
    {
        return $this->dateDePost;
    }

    /**
     * @param \DateTime $dateDePost
     * @return PostDto
     */
    public function setDateDePost(\DateTime $dateDePost): PostDto
    {
        $this->dateDePost = $dateDePost;
        return $this;
    }

    /**
     * @return array
     */
    public function getCommentaires(): array
    {
        return $this->commentaires;
    }

    /**
     * @param array $commentaires
     * @return PostDto
     */
    public function setCommentaires(array $commentaires): PostDto
    {
        $this->commentaires = $commentaires;
        return $this;
    }



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return PostDto
     */
    public function setId(int $id): PostDto
    {
        $this->id = $id;
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
     * @return PostDto
     */
    public function setContenu(string $contenu): PostDto
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
     * @return PostDto
     */
    public function setUserID(int $userID): PostDto
    {
        $this->userID = $userID;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMedia(): ?string
    {
        return $this->media;
    }

    /**
     * @param string|null $media
     * @return PostDto
     */
    public function setMedia(?string $media): PostDto
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
     * @return PostDto
     */
    public function setTypemedia(?string $typemedia): PostDto
    {
        $this->typemedia = $typemedia;
        return $this;
    }










}




