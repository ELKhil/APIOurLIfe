<?php

namespace App\Dto;

class DonationDto
{
    private int $id;
    private float $amount;



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