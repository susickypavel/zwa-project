<?php

namespace App\Entity;

use App\Repository\WorldUploadRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorldUploadRepository::class)
 */
class WorldUpload
{
    public function __construct() {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $worldData = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="worldUploads")
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $saveGameInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $worldState;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorldData(): ?array
    {
        return $this->worldData;
    }

    public function setWorldData(array $worldData): self
    {
        $this->worldData = $worldData;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getSaveGameInfo(): ?string
    {
        return $this->saveGameInfo;
    }

    public function setSaveGameInfo(?string $saveGameInfo): self
    {
        $this->saveGameInfo = $saveGameInfo;

        return $this;
    }

    public function getWorldState(): ?string
    {
        return $this->worldState;
    }

    public function setWorldState(?string $worldState): self
    {
        $this->worldState = $worldState;

        return $this;
    }
}
