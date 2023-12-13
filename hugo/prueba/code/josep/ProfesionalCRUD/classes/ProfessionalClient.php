<?php

class ProfessionalClient extends Client {
    private string $lopd;
    private string $cif;
    private string $managerNif;
    private string $constitutionWriting;
    private string $suscription;

    public function __construct($id, $name, $lastname, $email, $username, $address, $businessName, $dni, $phone, $targetNum, $type, $passwd, $lopd, $cif, $managerNif, $constitutionWriting, $suscription) {
        parent::__construct($id, $name, $lastname, $email, $username, $address, $businessName, $dni, $phone, $targetNum, $type, $passwd);

        $this->lopd = $lopd;
        $this->cif = $cif;
        $this->managerNif = $managerNif;
        $this->constitutionWriting = $constitutionWriting;
        $this->suscription = $suscription;
    }

    public function getLopd(): string {
        return $this->lopd;
    }

    public function getCif(): string {
        return $this->cif;
    }

    public function getManagerNif(): string {
        return $this->managerNif;
    }

    public function getConstitutionWriting(): string {
        return $this->constitutionWriting;
    }

    public function getSuscription(): string {
        return $this->suscription;
    }

}