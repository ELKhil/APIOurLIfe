<?php

namespace App\Dto\Message;

class MessageDto
{

    private int $id;
    private string $contenu;
    private \DateTimeImmutable $createdAt;

    private int $sentFromId;
    private string $sentFromFullName;
    private string $sentFromImage;


    private int $sentToId;
    private string $sentToFullName;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return MessageDto
     */
    public function setId(int $id): MessageDto
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
     * @return MessageDto
     */
    public function setContenu(string $contenu): MessageDto
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     * @return MessageDto
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): MessageDto
    {
        $this->createdAt = $createdAt;
        return $this;
    }



    /**
     * @return int
     */
    public function getSentFromId(): int
    {
        return $this->sentFromId;
    }

    /**
     * @param int $sentFromId
     * @return MessageDto
     */
    public function setSentFromId(int $sentFromId): MessageDto
    {
        $this->sentFromId = $sentFromId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSentFromFullName(): string
    {
        return $this->sentFromFullName;
    }

    /**
     * @param string $sentFromFullName
     * @return MessageDto
     */
    public function setSentFromFullName(string $sentFromFullName): MessageDto
    {
        $this->sentFromFullName = $sentFromFullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getSentFromImage(): string
    {
        return $this->sentFromImage;
    }

    /**
     * @param string $sentFromImage
     * @return MessageDto
     */
    public function setSentFromImage(string $sentFromImage): MessageDto
    {
        $this->sentFromImage = $sentFromImage;
        return $this;
    }

    /**
     * @return int
     */
    public function getSentToId(): int
    {
        return $this->sentToId;
    }

    /**
     * @param int $sentToId
     * @return MessageDto
     */
    public function setSentToId(int $sentToId): MessageDto
    {
        $this->sentToId = $sentToId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSentToFullName(): string
    {
        return $this->sentToFullName;
    }

    /**
     * @param string $sentToFullName
     * @return MessageDto
     */
    public function setSentToFullName(string $sentToFullName): MessageDto
    {
        $this->sentToFullName = $sentToFullName;
        return $this;
    }


    /**
     * @return string
     */
    public function getSentToImage(): string
    {
        return $this->sentToImage;
    }

    /**
     * @param string $sentToImage
     * @return MessageDto
     */
    public function setSentToImage(string $sentToImage): MessageDto
    {
        $this->sentToImage = $sentToImage;
        return $this;
    }
    private string $sentToImage;
}