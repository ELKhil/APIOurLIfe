<?php

namespace App\Dto;

class DonationDto
{
    private int $id;
    private float $amount;
    private string $name;
    private  \DateTimeImmutable $createdAt;



    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return DonationDto
     */
    public function setName(string $name): DonationDto
    {
        $this->name = $name;
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
     * @return DonationDto
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): DonationDto
    {
        $this->createdAt = $createdAt;
        return $this;
    }



    /**
     * @param int $id
     * @return DonationDto
     */
    public function setId(int $id): DonationDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param float $amount
     * @return DonationDto
     */
    public function setAmount(float $amount): DonationDto
    {
        $this->amount = $amount;
        return $this;
    }


}