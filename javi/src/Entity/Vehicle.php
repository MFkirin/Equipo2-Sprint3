<?php

declare(strict_types=1);

namespace App\Entity;
use App\Core\EntityInterface;
use DateTime;

class Vehicle implements EntityInterface
{
    private int $id;
    private string $plate;
    private string $observedDamages;
    private int $kilometers;
    private float $buyPrice;
    private float $sellPrice;
    private string $fuel;
    private float $IVA;
    private string $description;
    private string $chassisNumber;
    private string $gearbox;
    private array $images = [];
    private bool $isNew;
    private bool $transportIncluded;
    private string $color;
    private DateTime $registrationDate;
    private Provider $provider;
    private Model $model;
    private int $providerId;
    private int $modelId;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPlate(): string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): void
    {
        $this->plate = $plate;
    }

    public function getObservedDamages(): string
    {
        return $this->observedDamages;
    }

    public function setObservedDamages(string $observedDamages): void
    {
        $this->observedDamages = $observedDamages;
    }

    public function getKilometers(): int
    {
        return $this->kilometers;
    }

    public function setKilometers(int $kilometers): void
    {
        $this->kilometers = $kilometers;
    }

    public function getBuyPrice(): float
    {
        return $this->buyPrice;
    }

    public function setBuyPrice(float $buyPrice): void
    {
        $this->buyPrice = $buyPrice;
    }

    public function getSellPrice(): float
    {
        return $this->sellPrice;
    }

    public function setSellPrice(float $sellPrice): void
    {
        $this->sellPrice = $sellPrice;
    }

    public function getFuel(): string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): void
    {
        $this->fuel = $fuel;
    }

    public function getIVA(): float
    {
        return $this->IVA;
    }

    public function setIVA(float $IVA): void
    {
        $this->IVA = $IVA;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getChassisNumber(): string
    {
        return $this->chassisNumber;
    }

    public function setChassisNumber(string $chassisNumber): void
    {
        $this->chassisNumber = $chassisNumber;
    }

    public function getGearbox(): string
    {
        return $this->gearbox;
    }

    public function setGearbox(string $gearbox): void
    {
        $this->gearbox = $gearbox;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    public function isNew(): bool
    {
        return $this->isNew;
    }

    public function setIsNew(bool $isNew): void
    {
        $this->isNew = $isNew;
    }

    public function isTransportIncluded(): bool
    {
        return $this->transportIncluded;
    }

    public function setTransportIncluded(bool $transportIncluded): void
    {
        $this->transportIncluded = $transportIncluded;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getRegistrationDate(): DateTime
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(DateTime $registrationDate): void
    {
        $this->registrationDate = $registrationDate;
    }

    public function getProvider(): Provider
    {
        return $this->provider;
    }

    public function setProvider(Provider $provider): void
    {
        $this->provider = $provider;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function getProviderId(): int
    {
        return $this->providerId;
    }

    public function setProviderId(int $providerId): void
    {
        $this->providerId = $providerId;
    }

    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function setModelId(int $modelId): void
    {
        $this->modelId = $modelId;
    }

    public static function fromArray(array $array): EntityInterface
    {
        $vehicle = new Vehicle();
        $vehicle->setId($array["id"]);
        $vehicle->setPlate($array["plate"]);
        $vehicle->setObservedDamages($array["observed_damages"]);
        $vehicle->setKilometers($array["kilometers"]);
        $vehicle->setBuyPrice($array["buy_price"]);
        $vehicle->setSellPrice($array["sell_price"]);
        $vehicle->setFuel($array["fuel"]);
        $vehicle->setIVA($array["iva"]);
        $vehicle->setDescription($array["description"]);
        $vehicle->setChassisNumber($array["chassis_number"]);
        $vehicle->setGearbox($array["gearbox"]);
        $vehicle->setIsNew((bool)$array["is_new"]);
        $vehicle->setTransportIncluded((bool)$array["transport_included"]);
        $vehicle->setColor($array["color"]);
        $vehicle->setRegistrationDate(new DateTime($array["registration_date"]));
        $vehicle->setProviderId((int)$array["provider_id"]);
        $vehicle->setModelId((int)$array["model_id"]);


        return $vehicle;
    }

    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "plate" => $entity->getPlate(),
            "observed_damages" => $entity->getObservedDamages(),
            "kilometers" => $entity->getKilometers(),
            "buy_price" => $entity->getBuyPrice(),
            "sell_price" => $entity->getSellPrice(),
            "fuel" => $entity->getFuel(),
            "iva" => $entity->getIVA(),
            "description" => $entity->getDescription(),
            "chassis_number" => $entity->getChassisNumber(),
            "gearbox" => $entity->getGearbox(),
            "is_new" => $entity->isNew(),
            "transport_included" => $entity->isTransportIncluded(),
            "color" => $entity->getColor(),
            "registration_date" => $entity->getRegistrationDate()->format('Y-m-d'),
            "provider_id" => $entity->getProviderId(),
            "model_id" => $entity->getModelId(),
        ];
    }
}