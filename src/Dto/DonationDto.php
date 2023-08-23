<?php

namespace App\Dto;

class DonationDto
{

    private float $amount;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
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