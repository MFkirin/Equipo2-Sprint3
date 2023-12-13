<?php

namespace App\Entity;
class Professional extends Customer
{
    private string $CIF;
    private string $managerNIF;
    private string $LOPD;
    private string $constitutionWriting;
    private bool $subscription;

    public function getCIF(): string
    {
        return $this->CIF;
    }

    public function setCIF(string $CIF): void
    {
        $this->CIF = $CIF;
    }

    public function getManagerNIF(): string
    {
        return $this->managerNIF;
    }

    public function setManagerNIF(string $managerNIF): void
    {
        $this->managerNIF = $managerNIF;
    }

    public function getLOPD(): string
    {
        return $this->LOPD;
    }

    public function setLOPD(string $LOPD): void
    {
        $this->LOPD = $LOPD;
    }

    public function getConstitutionWriting(): string
    {
        return $this->constitutionWriting;
    }

    public function setConstitutionWriting(string $constitutionWriting): void
    {
        $this->constitutionWriting = $constitutionWriting;
    }

    public function isSubscription(): bool
    {
        return $this->subscription;
    }

    public function setSubscription(bool $subscription): void
    {
        $this->subscription = $subscription;
    }
}