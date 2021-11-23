<?php

namespace App\Entity;

use App\DTO\RequestDTO;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RequestRepository")
 */
class Request
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, name="title")
     */
    private string $title;

    /**
     * @ORM\Column(type="text", name="message")
     */
    private string $message;

    /**
     * @ORM\Column(type="smallint", options={"default": 0}, name="status")
     */
    private int $status = 0;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private DateTime $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="requests")
     */
    private ?User $createdBy;

    public static function createFromDTO(RequestDTO $requestDTO): self
    {
        $title = $requestDTO->getTitle();
        $message = $requestDTO->getMessage();
        return new self($title, $message);
    }

    public function __construct(string $title, string $message)
    {
        $this->title = $title;
        $this->message = $message;
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function updateFromDTO(RequestDTO $requestDTO)
    {
        $this->title = $requestDTO->getTitle();
        $this->message = $requestDTO->getMessage();
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}