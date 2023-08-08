<?php

namespace App\Dto\post;

use App\Entity\User;

class AffichePosts
{
    private ?string $media;
    private ?string $contenu;
    private ?string $typemedia;
    private int $id;
    private array $commentaires = [];
    private \DateTime $dateDePost;
    private bool $active;
    private int $like;
    private int $dislike;
    private string $imageUser;
    private string $nomUser;

    /**
     * @return string
     */
    public function getNomUser(): string
    {
        return $this->nomUser;
    }

    /**
     * @param string $nomUser
     * @return AffichePosts
     */
    public function setNomUser(string $nomUser): AffichePosts
    {
        $this->nomUser = $nomUser;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageUser(): string
    {
        return $this->imageUser;
    }

    /**
     * @param string $imageUser
     * @return AffichePosts
     */
    public function setImageUser(string $imageUser): AffichePosts
    {
        $this->imageUser = $imageUser;
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
     * @return AffichePosts
     */
    public function setMedia(?string $media): AffichePosts
    {
        $this->media = $media;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    /**
     * @param string|null $contenu
     * @return AffichePosts
     */
    public function setContenu(?string $contenu): AffichePosts
    {
        $this->contenu = $contenu;
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
     * @return AffichePosts
     */
    public function setTypemedia(?string $typemedia): AffichePosts
    {
        $this->typemedia = $typemedia;
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
     * @return AffichePosts
     */
    public function setId(int $id): AffichePosts
    {
        $this->id = $id;
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
     * @return AffichePosts
     */
    public function setCommentaires(array $commentaires): AffichePosts
    {
        $this->commentaires = $commentaires;
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
     * @return AffichePosts
     */
    public function setDateDePost(\DateTime $dateDePost): AffichePosts
    {
        $this->dateDePost = $dateDePost;
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
     * @return AffichePosts
     */
    public function setActive(bool $active): AffichePosts
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return int
     */
    public function getLike(): int
    {
        return $this->like;
    }

    /**
     * @param int $like
     * @return AffichePosts
     */
    public function setLike(int $like): AffichePosts
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
     * @return AffichePosts
     */
    public function setDislike(int $dislike): AffichePosts
    {
        $this->dislike = $dislike;
        return $this;
    }






}