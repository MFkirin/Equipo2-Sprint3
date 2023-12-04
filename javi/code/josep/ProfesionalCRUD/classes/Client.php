<?php

class Client
{
    private string $id;
    private string $name;
    private string $lastname;
    private string $email;
    private string $username;
    private string $address;
    private string $businessName;
    private string $nif;
    private string $phone;
    private string $targetNum;
    private string $type;
    private string $passwd;

    public function __construct(string $id, string $name, string $lastname, string $email, string $username, string $address, string $businessName, string $nif, string $phone, string $targetNum, string $type, string $passwd)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->username = $username;
        $this->address = $address;
        $this->businessName = $businessName;
        $this->nif = $nif;
        $this->phone = $phone;
        $this->targetNum = $targetNum;
        $this->type = $type;
        $this->passwd = $passwd;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getBusinessName(): string {
        return $this->businessName;
    }

    public function getDni(): string {
        return $this->nif;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getTargetNum(): string {
        return $this->targetNum;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getPasswd(): string {
        return $this->passwd;
    }



}