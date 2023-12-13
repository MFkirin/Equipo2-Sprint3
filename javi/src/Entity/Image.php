<?php
declare(strict_types=1);

namespace App\Entity;
use App\Core\EntityInterface;

class Image implements EntityInterface
{
    private int $id;
    private string $filename;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    public static function fromArray(array $array): EntityInterface
    {
        $image = new Image();
        $image->setId($array["id"]);
        $image->setFilename($array["filename"]);

        return $image;
    }

    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "filename" => $entity->getFilename()
        ];
    }
}