<?php
/**
 *   En aquesta classe estaràn els atributs i funcions de la comanda
 *   per tal d'emmagatzemar les seves dades en el sistema i oferir-lu una millor experiencia en ell
 *
 *   @name Equip3-Cataleg i Procés de Venta
 *   @since 02-10-2023
 *   @version 1.0
 */
class Comanda {
    private string $vehicle;
    private int $codiDeComanda;
    private string $estatVehicle;

    public function __construct() {
        $this->vehicle = "";
        $this->codiDeComanda = 0;
        $this->estatVehicle = "";
    }

    /**
     * Mètode que retorna un nom de vehicle aleatori
     * @return string
     */
    public function generarVehicleAleatori(): string {
        $vehicles = ["Ferrari", "Aston Martin", "Bugatti", "Mclaren", "Bentley"];
        return $vehicles[array_rand($vehicles)];
    }

    /**
     * Mètode que genera un codi de comanda aleatori
     * @return int
     */
    public function generarCodiComandaAleatori(): int {
        return rand(1, 10);
    }

    /**
     * Mètode que genera un estat del vehicle aleatori
     * @return string
     */
    public function generarEstatVehicleAleatori(): string {
        $estats = ["Nou", "Ocasió", "Seminou"];
        return $estats[array_rand($estats)];
    }

    public function getVehicle(): string {
        return $this->vehicle;
    }

    public function setVehicle(string $vehicle): void {
        $this->vehicle = $vehicle;
    }

    public function getCodiDeComanda(): int {
        return $this->codiDeComanda;
    }

    public function setCodiDeComanda(int $codiDeComanda): void {
        $this->codiDeComanda = $codiDeComanda;
    }

    public function getEstatVehicle(): string {
        return $this->estatVehicle;
    }

    public function setEstatVehicle(string $estatVehicle): void {
        $this->estatVehicle = $estatVehicle;
    }
}
?>
