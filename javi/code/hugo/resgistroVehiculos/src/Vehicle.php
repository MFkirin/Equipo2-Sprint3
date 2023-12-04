<?php

class Vehicle
{
    private $id;
    private $nombre;
    private $marca;
    private $modelo;
    private $matricula;
    private $danoObservados;
    private $descripComercial;
    private $km;
    private $precioCompra;
    private $precioVenta;
    private $iva;
    private $nou;
    private $transInc;
    private $numBastidor;
    private $color;
    private $fechaMatriculacion;
    private $documentacion;
    private $proveedor;
    private $imagen;

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}