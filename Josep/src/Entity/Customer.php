<?php

declare(strict_types=1);

namespace App\Entity;
class Customer implements EntityInterface
{
    private int $id;
    private string $name;
    private string $lastname;
    private string $address;
    private string $dni;
    private string $phone;
    private string $businessName;
    private string $email;
    private Login $login;
    private int $login_id;

    public function getLoginId(): int
    {
        return $this->login_id;
    }

    public function setLoginId(int $login_id): void
    {
        $this->login_id = $login_id;
    }

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

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    public function setDni(string $dni): void
    {
        $this->dni = $dni;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getBusinessName(): string
    {
        return $this->businessName;
    }

    public function setBusinessName(string $businessName): void
    {
        $this->businessName = $businessName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getLogin(): Login
    {
        return $this->login;
    }

    public function setLogin(Login $login): void
    {
        $this->login = $login;
    }

    public static function fromArray(array $array): EntityInterface
    {
        // TODO: Implement fromArray() method.
        $customer = new Customer();
        $customer->setId($array["id"]);
        $customer->setName($array["name"]);
        $customer->setLastname($array["lastname"]);
        $customer->setAddress($array["address"]);
        $customer->setDni($array["dni"]);
        $customer->setPhone($array["phone"]);
        $customer->setBusinessName($array["bussiness_name"]);
        $customer->setEmail($array["email"]);
        $customer->setLoginId($array["login_id"]);

        return $customer;
    }

    public static function toArray(EntityInterface $entity): array
    {
        // TODO: Implement toArray() method.
        return [
            "id" => $entity->getId(),
            "name" => $entity->getName(),
            "lastname" => $entity->getLastname(),
            "address" => $entity->getAddress(),
            "dni" => $entity->getDni(),
            "phone" => $entity->getPhone(),
            "bussiness_name" => $entity->getBusinessName(),
            "email" => $entity->getEmail(),
            "login_id" => $entity->getLoginId()
        ];
    }
}
