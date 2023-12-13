<?php
declare(strict_types=1);

require_once __DIR__ . '/../Core/EntityInterface.php';

class Login implements EntityInterface
{
    private int $id;
    private string $username;
    private string $password;
    private string $role;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public static function fromArray(array $array): EntityInterface
    {
        $login = new Login();
        $login->setId($array["id"]);
        $login->setUsername($array["username"]);
        $login->setPassword($array["password"]);
        $login->setRole($array["role"]);
        return $login;
    }


    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "username" => $entity->getUsername(),
            "password" => $entity->getPassword(),
            "role" => $entity->getRole()
        ];
    }
}