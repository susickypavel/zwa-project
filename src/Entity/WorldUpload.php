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
}
