<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class RequestDTO
{
    /**
     * @Assert\NotBlank(message="Поле не может быть пустым")
     * @Assert\Length(max="255", maxMessage="Заголовок не может содержать больше 255 символов")
     */
    private ?string $title;

    /**
     * @Assert\NotBlank(message="Поле не может быть пустым")
     * @Assert\Length(max=65535, maxMessage="Сообщение не может содержать более 65535 символов")
     */
    private ?string $message;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

}