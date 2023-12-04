<?php

declare(strict_types=1);

require_once __DIR__. '/../Core/EntityInterface.php';

class Image implements EntityInterface {
    private int $id;
    private string $filename;
    private int $vehicle_id;

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getFilename(): string {
        return $this->filename;
    }

    public function setFilename(string $filename): void {
        $this->filename = $filename;
    }

    public function getVehicleId(): int {
        return $this->vehicle_id;
    }

    public function setVehicleId(int $vehicle_id): void {
        $this->vehicle_id = $vehicle_id;
    }

    public static function fromArray(array $array): EntityInterface {
        $image = new Image();
        $image->setId($array["id"]);
        $image->setFilename($array["filename"]);
        $image->setVehicleId($array["vehicle_id"]);

        return $image;
    }

    public static function toArray(EntityInterface $entity): array {
        return [
            "id" => $entity->getId(),
            "filename" => $entity->getFilename(),
            "vehicle_id" => $entity->getVehicleId()
        ];
    }
}