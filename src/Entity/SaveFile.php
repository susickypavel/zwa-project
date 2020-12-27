<?php

namespace App\Entity;

use App\Repository\SaveFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=SaveFileRepository::class)
 */
class SaveFile
{
    // TODO: fix timezone

    /**
     * @var \DateTime
     * @Gedmo\Mapping\Annotation\Timestampable(on="create")
     * @Doctrine\ORM\Mapping\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Mapping\Annotation\Timestampable(on="update")
     * @Doctrine\ORM\Mapping\Column(type="datetime")
     */
    protected $updatedAt;

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

    /**
     * @ORM\Column(type="json")
     */
    private $worldData = [];

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

    public function getWorldData(): ?array
    {
        return $this->worldData;
    }

    public function setWorldData(array $worldData): self
    {
        $this->worldData = $worldData;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void {

    }
}
