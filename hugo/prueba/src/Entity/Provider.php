<?php

declare(strict_types=1);

require_once __DIR__ . '/../Core/EntityInterface.php';

class Provider implements EntityInterface
{
    //Attributes
    private int $id;
    private string $email;
    private string $phone;
    private string $dni;
    private string $cif;
    private string $address;
    private string $bankTitle;
    private string $managerNIF;
    private string $LOPDdoc;
    private string $constitutionArticle;

    //Getters ans Setters

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    public function setDni(string $dni): void
    {
        $this->dni = $dni;
    }

    public function getCif(): string
    {
        return $this->cif;
    }

    public function setCif(string $cif): void
    {
        $this->cif = $cif;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getBankTitle(): string
    {
        return $this->bankTitle;
    }

    public function setBankTitle(string $bankTitle): void
    {
        $this->bankTitle = $bankTitle;
    }

    public function getManagerNIF(): string
    {
        return $this->managerNIF;
    }

    public function setManagerNIF(string $managerNIF): void
    {
        $this->managerNIF = $managerNIF;
    }

    public function getLOPDdoc(): string
    {
        return $this->LOPDdoc;
    }

    public function setLOPDdoc(string $LOPDdoc): void
    {
        $this->LOPDdoc = $LOPDdoc;
    }

    public function getConstitutionArticle(): string
    {
        return $this->constitutionArticle;
    }

    public function setConstitutionArticle(string $constitutionArticle): void
    {
        $this->constitutionArticle = $constitutionArticle;
    }

    public function getId(): int
    {
        return $this->id;
    }

    private function setId(int $id)
    {
        $this->id = $id;
    }


    public static function fromArray(array $array): EntityInterface
    {
        $provider = new Provider();
        $provider->setId($array["id"]);
        $provider->setEmail($array["email"]);
        $provider->setPhone($array["phone"]);
        $provider->setDni($array["dni"]);
        $provider->setCif($array["cif"]);
        $provider->setAddress($array["address"]);
        $provider->setBankTitle($array["bank_title"]);
        $provider->setManagerNIF($array["manager_nif"]);
        $provider->setLOPDdoc($array["lopd_doc"]);
        $provider->setConstitutionArticle($array["constitution_article"]);
        return $provider;
    }


    public static function toArray(EntityInterface $entity): array
    {
        return [
            "id" => $entity->getId(),
            "email" => $entity->getEmail(),
            "phone" => $entity->getPhone(),
            "dni" => $entity->getDni(),
            "cif" => $entity->getCif(),
            "address" => $entity->getAddress(),
            "bank_title" => $entity->getBankTitle(),
            "manager_nif" => $entity->getManagerNif(),
            "lopd_doc" => $entity->getLOPDdoc(),
            "constitution_article" => $entity->getConstitutionArticle()
        ];
    }
}