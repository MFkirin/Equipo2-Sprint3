<?php
declare(strict_types=1);

namespace App\Entity;

use App\Core\EntityInterface;

class Brand implements EntityInterface
{
    private int $id;
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public static function fromArray(array $array): EntityInterface
    {
        $brand = new Brand();
        $brand->setId($array["id"]);
        $brand->setName($array["name"]);

        return $brand;
    }

    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "name" => $entity->getName()
        ];
    }
}