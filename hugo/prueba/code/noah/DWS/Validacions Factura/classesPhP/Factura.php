<?php
/**
 *   En aquesta classe estaran els atributs i funcions de la factura
 *   per a emmagatzemar les seves dades en el sistema i oferir una millor experiència en ell
 *
 *   @name Equip3-Catàleg i Procés de Venda
 *   @since 02-10-2023
 *   @version 1.0
 */
class Factura {
    private string $proveidor;
    private string $client;
    private string $comanda;
    private DateTime $data;
    private int $numFactura;
    private float $preu;
    private string $producte;
    private int $quantitat;

    public function __construct() {
        $this->proveidor = "";
        $this->client = "";
        $this->comanda = "";
        $this->data = new DateTime();
        $this->numFactura = 0;
        $this->preu = 0.0;
        $this->producte = "";
        $this->quantitat = 0;
    }

    /**
     * Funció que retorna un proveïdor de manera aleatòria
     * @return string
     */
    public function obtenirProveidorAleatori(): string {
        $proveidors = ["Audi, S.A", "Ford, S.A", "Ferrari, S.A", "Koenigsegg, S.A"];
        return $proveidors[array_rand($proveidors)];
    }

    /**
     * Funció que retorna un client de manera aleatòria
     * @return string
     */
    public function obtenirClientAleatori(): string {
        $clients = ["Jesus de Barqueta", "Pepe Marti", "Julian Alvarez"];
        return $clients[array_rand($clients)];
    }

    /**
     * Funció per a generar un preu aleatòri
     * @return float
     */
    public function generarPreuAleatori(): float {
        return rand(100, 500000) / 100; // Preu entre 1 i 5000 euros
    }

    /**
     * Funció per a generar un producte aleatòri
     * @return string
     */
    public function generarProducteAleatori(): string {
        $productes = ["Cotxe", "Neumàtics", "Xassís", "Aleró"];
        return $productes[array_rand($productes)];
    }

    /**
     * Funció per a generar una quantitat aleatòria
     * @return int
     */
    public function generarQuantitatAleatoria(): int {
        return rand(1, 10);
    }

    /**
     * Funció per a generar un número de factura aleatori
     * @return int
     */
    public function generarNumeroFacturaAleatori(): int {
        return rand(1, 10);
    }

    /**
     * Funció per a calcular el total de la factura
     * @param float $preu
     * @param int $quantitat
     * @return float
     */
    public function calcularTotal(float $preu, int $quantitat): float {
        return $preu * $quantitat;
    }

    /**
     * Mètode que genera una data en el format adequat
     * @return string
     */
    public function generarDataActual(): string {
        return $this->data->format('d/m/Y');
    }

    public function getProveidor(): string
    {
        return $this->proveidor;
    }

    public function setProveidor(string $proveidor): void
    {
        $this->proveidor = $proveidor;
    }

    public function getClient(): string
    {
        return $this->client;
    }

    public function setClient(string $client): void
    {
        $this->client = $client;
    }

    public function getDataAsString(): string
    {
        return $this->data->format('Y-m-d'); // Puedes ajustar el formato según tus necesidades
    }


    public function setData(string $data): void
    {
        $this->data = new DateTime($data);
    }

    public function getNumFactura(): int
    {
        return $this->numFactura;
    }

    public function setNumFactura(int $numFactura): void
    {
        $this->numFactura = $numFactura;
    }

    public function getPreu(): float
    {
        return $this->preu;
    }

    public function setPreu(float $preu): void
    {
        $this->preu = $preu;
    }

    public function getProducte(): string
    {
        return $this->producte;
    }

    public function setProducte(string $producte): void
    {
        $this->producte = $producte;
    }

    public function getQuantitat(): int
    {
        return $this->quantitat;
    }

    public function setQuantitat(int $quantitat): void
    {
        $this->quantitat = $quantitat;
    }

    public function getComanda(): string
    {
        return $this->comanda;
    }

    public function setComanda(string $comanda): void
    {
        $this->comanda = $comanda;
    }


    /**
     * Mètode per a validar el preu
     * @param float $preu
     */
    public function validarPreu(float $preu): void {
        if ($preu > 499999.99) {
            echo "El preu no pot ser superior a 499999.99 €";
        }
    }
}
?>
