<?php

namespace App\DTO;

class UserDTO
{
    private ?string $email;

    private ?string $plainPassword;

    private ?string $hashPassword;

    public function getHashPassword(): ?string
    {
        return $this->hashPassword;
    }

    public function setHashPassword(?string $hashPassword): void
    {
        $this->hashPassword = $hashPassword;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }
}