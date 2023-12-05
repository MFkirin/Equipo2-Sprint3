<?php

require_once __DIR__ . "/Customer.php";
require_once __DIR__ . '/../Core/EntityInterface.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Repository/CustomerRepository.php';

class Order implements EntityInterface
{
    private int $id;
    private array $vehicles = [];
    private string $state;
    private Customer $customer;

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

    public function setCustomerId(int $customerId, CustomerRepository $customerRepository, Order $order): void
    {
        $this->id = $customerId;
        $customer = $customerRepository->find($customerId);
        $order->setCustomer($customer);
    }

    public static function fromArray(array $array): EntityInterface
    {
        $config = require __DIR__ . '/../../config/config.php';
        $database = new Database($config["database"]);
        $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

        $order = new Order();
        $order->setId($array["id"]);
        $order->setVehicles($array["vehicles"]);
        $order->setState($array["state"]);

        $customerId = (int)$array["customer_id"];
        $order->setCustomerId($customerId);

        return $order;
    }

    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "vehicles[]" => $entity->getVehicles(),
            "state" => $entity->getState(),
            "customer_id" => $entity->getCustomer()->getId(),
        ];
    }
}