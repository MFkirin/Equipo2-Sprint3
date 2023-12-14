<?php

namespace Entity;

use DateTime;

class Vehicle
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
    private string $gearShift;
    private float $purchasePrice;
    private array $images = [];
    private bool $isNew;
    private bool $transportIncluded;
    private string $color;
    private DateTime $registrationDate;
    private array $documents = [];
    private Provider $provider;
    private Model $model;

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

    public function getGearShift(): string
    {
        return $this->gearShift;
    }

    public function setGearShift(string $gearShift): void
    {
        $this->gearShift = $gearShift;
    }

    public function getPurchasePrice(): float
    {
        return $this->purchasePrice;
    }

    public function setPurchasePrice(float $purchasePrice): void
    {
        $this->purchasePrice = $purchasePrice;
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

    public function getDocuments(): array
    {
        return $this->documents;
    }

    public function setDocuments(array $documents): void
    {
        $this->documents = $documents;
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
}