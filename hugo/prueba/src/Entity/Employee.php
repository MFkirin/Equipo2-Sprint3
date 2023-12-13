<?php
declare(strict_types=1);

require_once __DIR__ . '/../Core/EntityInterface.php';

class Employee implements EntityInterface
{
    private int $id;
    private string $name;
    private string $lastname;
    private string $type;
    private Login $login;

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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
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
        $employee = new Employee();
        $employee->setId($array["id"]);
        $employee->setName($array["name"]);
        $employee->setLastname($array["lastname"]);
        $employee->setType($array["type"]);
        return $employee;
    }

    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "name" => $entity->getName(),
            "lastname" => $entity->getLastName(),
            "type" => $entity->getType()
        ];
    }
}