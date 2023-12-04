<?php

//Classe
class Comanda
{
    //Atributs
    private int $id;
    private string $name;
    private string $surname;
    private int $num_vehicles;

    private int $plate;
    private string $state;
    private string $invoice;

    //Constructor
    public function __construct(
        int $id,
        string $name,
        string $surname,
        int $plate,
        int $num_vehicles,
        string $state,
        string $invoice
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->plate = $plate;
        $this->num_vehicles = $num_vehicles;
        $this->state = $state;
        $this->invoice = $invoice;
    }

    /* Mètodes gets/sets */

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function setNumVehicles(int $num_vehicles): void
    {
        $this->num_vehicles = $num_vehicles;
    }

    public function setPlate(int $plate): void
    {
        $this->plate = $plate;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function setInvoice(string $invoice): void
    {
        $this->invoice = $invoice;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getNumVehicles(): int
    {
        return $this->num_vehicles;
    }

    public function getPlate(): int
    {
        return $this->plate;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getInvoice(): string
    {
        return $this->invoice;
    }

    /* Mètodes validació formulari */

    /**
     * @param int $id
     * @return string
     */
    public static function validateID(int $id): string
    {
        if (empty($id)) {
            return "ID is required." . " ";
        } elseif (!preg_match("/^\d{1,3}$/", $id)) {
            return "ID should only contain one number, two numbers o three numbers; no more." . " ";
        } else
            return "";
    }

    /**
     * @param string $name
     * @return string
     */
    public static function validateName(string $name): string
    {
        if (empty($name)) {
            return "Name is required." . " ";
        } elseif (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/", $name)) {
            return "Name should only contain letters." . " ";
        } else
            return "";
    }

    /**
     * @param string $surname
     * @return string
     */
    public static function validateSurname(string $surname): string
    {
        if (empty($surname)) {
            return "Surname is required." . " ";
        } elseif (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/", $surname)) {
            return "Surname should only contain letters." . " ";
        } else
            return "";
    }

    /**
     * @param int $num_vehicles
     * @return string
     */
    public static function validateNumberVehicles(int $num_vehicles): string
    {
        if (empty($num_vehicles)) {
            return "A number of vehicles is required." . " ";
        } elseif (!is_numeric($num_vehicles) || $num_vehicles < 1 || $num_vehicles > 100) {
            return "You only can buy between 1 and 100 vehicles." . " ";
        } else
            return "";
    }

    /**
     * @param string $invoice
     * @return string
     */
    public static function validateNumberPlate(string $invoice): string
    {
        if (empty($invoice)) {
            return "The number plate is necessary." . " ";
        } elseif (!preg_match('/^\d{4}[A-Z]{3}$/', $invoice)) {
            return "The number plate has to have four numbers and three capital letters." . " ";
        } else {
            return "";
        }
    }

    /**
     * @param string $state
     * @return string
     */
    public static function validateState(string $state): string
    {
        if ($state === "pending") {
            return "";
        } elseif ($state === "in_progress") {
            return "";
        } elseif ($state === "done") {
            return "";
        } else {
            return "Error";
        }
    }

    /**
     * @param int $id
     * @return string
     */
    public static function validateInvoice(int $id): string
    {
        if (empty($id)) {
            return "ID_Invoice is required." . " ";
        } elseif (!preg_match("/^\d{1,3}$/", $id)) {
            return "ID_Invoice should only contain one number, two numbers o three numbers; no more." . " ";
        } else
            return "";
    }
}