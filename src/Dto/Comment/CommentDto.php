<?php

namespace App\Dto\Comment;

class CommentDto
{
    private int $idMessage;
    private string $contenu;
    private int $postId;
    private string $userComImage;
    private string $userComNom;
    private bool $active;
    private \DateTime $dateMessage;

    /**
     * @return int
     */
    public function getIdMessage(): int
    {
        return $this->idMessage;
    }

    /**
     * @param int $idMessage
     * @return CommentDto
     */
    public function setIdMessage(int $idMessage): CommentDto
    {
        $this->idMessage = $idMessage;
        return $this;
    }


    /**
     * @return \DateTime
     */
    public function getDateMessage(): \DateTime
    {
        return $this->dateMessage;
    }

    /**
     * @param \DateTime $dateMessage
     * @return CommentDto
     */
    public function setDateMessage(\DateTime $dateMessage): CommentDto
    {
        $this->dateMessage = $dateMessage;
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
     * @return CommentDto
     */
    public function setActive(bool $active): CommentDto
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserComImage(): string
    {
        return $this->userComImage;
    }

    /**
     * @param string $userComImage
     * @return CommentDto
     */
    public function setUserComImage(string $userComImage): CommentDto
    {
        $this->userComImage = $userComImage;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserComNom(): string
    {
        return $this->userComNom;
    }

    /**
     * @param string $userComNom
     * @return CommentDto
     */
    public function setUserComNom(string $userComNom): CommentDto
    {
        $this->userComNom = $userComNom;
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
     * @return CommentDto
     */
    public function setContenu(string $contenu): CommentDto
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     * @return CommentDto
     */
    public function setPostId(int $postId): CommentDto
    {
        $this->postId = $postId;
        return $this;
    }





}