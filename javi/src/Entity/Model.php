<?php
declare(strict_types=1);

namespace App\Entity;

use App\Core\EntityInterface;

class Model implements EntityInterface
{
    private int $id;
    private string $name;
    private string $enginePower;
    private string $description;
    private Brand $brand;
    private int $brandId;
    private int $year;

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

    public function getEnginePower(): string
    {
        return $this->enginePower;
    }

    public function setEnginePower(string $enginePower): void
    {
        $this->enginePower = $enginePower;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function setBrand(Brand $brand): void
    {
        $this->brand = $brand;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function setBrandId(int $brandId): void
    {
        $this->brandId = $brandId;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public static function fromArray(array $array): EntityInterface
    {
        $model = new Model();
        $model->setId($array["id"]);
        $model->setName($array["name"]);
        $model->setEnginePower($array["enginePower"]);
        $model->setDescription($array["description"]);
        $model->setBrandId($array["brand_id"]);
        $model->setYear($array["year"]);

        return $model;
    }

    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "name" => $entity->getName(),
            "enginePower" => $entity->getEnginePower(),
            "description" => $entity->getDescription(),
            "brand_id" => $entity->getBrandId(),
            "year" => $entity->getYear(),
        ];
    }
}