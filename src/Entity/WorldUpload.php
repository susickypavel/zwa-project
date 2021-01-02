<?php

namespace App\Entity;

use App\Repository\WorldUploadRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorldUploadRepository::class)
 */
class WorldUpload
{
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
}
