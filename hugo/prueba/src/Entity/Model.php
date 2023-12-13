<?php

require_once __DIR__. '/../Core/EntityInterface.php';

class Model implements EntityInterface {
    private int $id;
    private string $name;
    private string $gearType;
    private string $description;
    private Brand $brand;
    private int $year;

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getGearType(): string {
        return $this->gearType;
    }

    public function setGearType(string $gearType): void {
        $this->gearType = $gearType;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getBrand(): Brand {
        return $this->brand;
    }

    public function setBrand(Brand $brand): void {
        $this->brand = $brand;
    }

    public function getYear(): int {
        return $this->year;
    }

    public function setYear(int $year): void {
        $this->year = $year;
    }

    public static function fromArray(array $array): EntityInterface {
        $name = new Model();
        $name->setId($array["id"]);
        $name->setName($array["name"]);
        return $name;
    }


    public static function toArray(EntityInterface $entity): array {
        return [
            "id" => $entity->getId(),
            "name" => $entity->getName()
        ];
    }
}