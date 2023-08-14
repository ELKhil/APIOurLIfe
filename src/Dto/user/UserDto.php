<?php

namespace App\Dto\user;

class UserDto
{
        private string $firstname;
        private string $lastname;
        private string $email;
        private string $password;
        private string $imageProfil;
        private int $stars;
        private string $branch;
        private string $restToken;

    /**
     * @return string
     */
    public function getBranch(): string
    {
        return $this->branch;
    }

    /**
     * @return string
     */
    public function getRestToken(): string
    {
        return $this->restToken;
    }

    /**
     * @param string $restToken
     * @return UserDto
     */
    public function setRestToken(string $restToken): UserDto
    {
        $this->restToken = $restToken;
        return $this;
    }

    /**
     * @param string $branch
     * @return UserDto
     */
    public function setBranch(string $branch): UserDto
    {
        $this->branch = $branch;
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
     * @return UserDto
     */
    public function setStars(int $stars): UserDto
    {
        $this->stars = $stars;
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
     * @return UserDto
     */
    public function setFirstname(string $firstname): UserDto
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
     * @return UserDto
     */
    public function setLastname(string $lastname): UserDto
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
     * @return UserDto
     */
    public function setEmail(string $email): UserDto
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
     * @return UserDto
     */
    public function setPassword(string $password): UserDto
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
     * @return UserDto
     */
    public function setImageProfil(string $imageProfil): UserDto
    {
        $this->imageProfil = $imageProfil;
        return $this;
    }




}