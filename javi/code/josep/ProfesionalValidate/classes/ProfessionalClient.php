<?php

class ProfessionalClient {
    private string $id;
    private string $name;
    private string $lastname;
    private string $email;
    private string $username;
    private string $nif;
    private string $businessName;
    private string $phone;
    private string $address;
    private string $cif;
    private string $passwd;
    private string $rpasswd;

    public function __construct(string $id, string $name, string $lastname, string $email, string $username, string $nif, string $businessName, string $phone, string $address, string $cif, string $passwd, string $rpasswd) {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->username = $username;
        $this->nif = $nif;
        $this->businessName = $businessName;
        $this->phone = $phone;
        $this->address = $address;
        $this->cif = $cif;
        $this->passwd = $passwd;
        $this->rpasswd = $rpasswd;
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

    public function getNif(): string {
        return $this->nif;
    }

    public function getBusinessName(): string {
        return $this->businessName;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getCif(): string {
        return $this->cif;
    }

    public function getPasswd(): string {
        return $this->passwd;
    }

    public function getRPasswd(): string {
        return $this->rpasswd;
    }
}