<?php

require_once __DIR__ . "/Order.php";
require_once __DIR__ . "/Customer.php";
require_once __DIR__ . '/../Core/EntityInterface.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Repository/CustomerRepository.php';
require_once __DIR__ . '/../Repository/OrderRepository.php';

class Invoice implements EntityInterface
{
    private int $id;
    private string $number;
    private float $price;
    private DateTime $date;
    private Customer $customer;
    private Order $order;

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

    public function setCustomerId(int $customerId, CustomerRepository $customerRepository, Invoice $invoice): void
    {
        $this->id = $customerId;
        $customer = $customerRepository->find($customerId);
        $invoice->setCustomer($customer);
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    public function setOrderId(int $orderId, OrderRepository $orderRepository, Invoice $invoice): void
    {
        $this->id = $orderId;
        $order = $orderRepository->find($orderId);
        $invoice->setOrder($order);
    }

    public static function fromArray(array $array): EntityInterface
    {
        $config = require_once __DIR__. '/../../config/config.php';
        $database = new Database($config["database"]);
        $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);
        $orderRepository = new OrderRepository($database->getConnection(), Order::class);

        $invoice = new Invoice();
        $invoice->setId($array["id"]);
        $invoice->setNumber($array["number"]);
        $invoice->setPrice($array["price"]);
        $invoice->setDate($array["date"]);

        $customerId = (int)$array["customer_id"];
        $invoice->setCustomerId($customerId);

        $orderId = (int)$array["order_id"];
        $invoice->setOrderId($orderId);

        return $invoice;
    }

    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "number" => $entity->getNumber(),
            "price" => $entity->getPrice(),
            "date" => $entity->getDate(),
            "customer_id" => $entity->getCustomer()->getId(),
            "order_id" => $entity->getOrder()->getId()
        ];
    }
}