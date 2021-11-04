<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
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
    private int $status;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private \DateTime $createdAt;

    public function __construct(string $title, string $message)
    {
        $this->title = $title;
        $this->message = $message;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}