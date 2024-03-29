<?php

namespace App\Dto\user;

class AfficheUser
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $imageProfil;
    private int $stars;
    private bool $active;
    private string $branch;
    private string $lastMessage;
    private \DateTimeImmutable $lastMessageDate;
    private int $unreadCount;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AfficheUser
     */
    public function setId(int $id): AfficheUser
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastMessage(): string
    {
        return $this->lastMessage;
    }

    /**
     * @param string $lastMessage
     * @return AfficheUser
     */
    public function setLastMessage(string $lastMessage): AfficheUser
    {
        $this->lastMessage = $lastMessage;
        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getLastMessageDate(): \DateTimeImmutable
    {
        return $this->lastMessageDate;
    }

    /**
     * @param \DateTimeImmutable|null $lastMessageDate
     * @return AfficheUser
     */
    public function setLastMessageDate(?\DateTimeImmutable $lastMessageDate): AfficheUser
    {
        $this->lastMessageDate = $lastMessageDate;
        return $this;
    }


    /**
     * @return int
     */
    public function getUnreadCount(): int
    {
        return $this->unreadCount;
    }

    /**
     * @param int $unreadCount
     * @return AfficheUser
     */
    public function setUnreadCount(int $unreadCount): AfficheUser
    {
        $this->unreadCount = $unreadCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getBranch(): string
    {
        return $this->branch;
    }

    /**
     * @param string $branch
     * @return AfficheUser
     */
    public function setBranch(string $branch): AfficheUser
    {
        $this->branch = $branch;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return AfficheUser
     */
    public function setFirstname(string $firstname): AfficheUser
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return AfficheUser
     */
    public function setLastname(string $lastname): AfficheUser
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return AfficheUser
     */
    public function setEmail(string $email): AfficheUser
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return AfficheUser
     */
    public function setPassword(string $password): AfficheUser
    {
        $this->password = $password;
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

    /**
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * @param int $stars
     * @return AfficheUser
     */
    public function setStars(int $stars): AfficheUser
    {
        $this->stars = $stars;
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
     * @return AfficheUser
     */
    public function setActive(bool $active): AfficheUser
    {
        $this->active = $active;
        return $this;
    }



}