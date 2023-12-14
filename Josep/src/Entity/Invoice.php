<?php
declare(strict_types=1);

namespace App\Entity;

use App\Core\EntityInterface;
use DateTime;

class Invoice implements EntityInterface
{
    private int $id;
    private string $number;
    private float $price;
    private DateTime $date;
    private Customer $customer;
    private Order $order;
    private int $customerId;
    private int $orderId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
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

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public static function fromArray(array $array): EntityInterface
    {
        $config = require __DIR__ . '/../../config/config.php';

        $invoice = new Invoice();
        $invoice->setId((int)$array["id"]);
        $invoice->setNumber((string)$array["number"]);
        $invoice->setPrice((float)$array["price"]);
        $invoice->setDate(new DateTime($array["date"]));
        $invoice->setCustomerId((int)$array["customer_id"]);
        $invoice->setOrderId((int)$array["order_id"]);

        return $invoice;
    }

    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "number" => (string)$entity->getNumber(),
            "price" => (float)$entity->getPrice(),
            "date" => $entity->getDate()->format('Y-m-d'),
            "customer_id" => (int)$entity->getCustomerId(),
            "order_id" => (int)$entity->getOrderId()
        ];
    }
}