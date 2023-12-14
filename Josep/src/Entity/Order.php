<?php
declare(strict_types=1);

namespace App\Entity;

class Order implements EntityInterface
{
    private int $id;
    private array $vehicles = [];
    private string $state;
    private Customer $customer ;
    private int $customerId;
    private float $totalPrice;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    public function setVehicles(array $vehicles): void
    {
        $this->vehicles = $vehicles;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    public static function fromArray(array $array): EntityInterface
    {
        $config = require __DIR__ . '/../../config/config.php';

        $order = new Order();
        $order->setId((int)$array["id"]);
        $order->setState((string)$array["state"]);
        $order->setCustomerId((int)$array["customer_id"]);

        return $order;
    }

    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "state" => (string)$entity->getState(),
            "customer_id" => (int)$entity->getCustomerId(),
        ];
    }
}