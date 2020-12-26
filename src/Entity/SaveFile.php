<?php

namespace App\Entity;

use App\Repository\SaveFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=SaveFileRepository::class)
 */
class SaveFile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gameInfoFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameInfoFile(): ?string
    {
        return $this->gameInfoFile;
    }

    public function setGameInfoFile(string $gameInfoFile): self
    {
        $this->gameInfoFile = $gameInfoFile;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void {

    }
}
