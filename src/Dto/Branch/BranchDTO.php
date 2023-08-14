<?php

namespace App\Dto\Branch;

class BranchDTO
{

    private int $id;
    private string $name;
    private string $anacad;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BranchDTO
     */
    public function setId(int $id): BranchDTO
    {
        $this->id = $id;
        return $this;
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
     * @return BranchDTO
     */
    public function setName(string $name): BranchDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnacad(): string
    {
        return $this->anacad;
    }

    /**
     * @param string $anacad
     * @return BranchDTO
     */
    public function setAnacad(string $anacad): BranchDTO
    {
        $this->anacad = $anacad;
        return $this;
    }




}