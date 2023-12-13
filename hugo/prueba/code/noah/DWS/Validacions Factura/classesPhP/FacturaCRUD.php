<?php

class FacturaCRUD {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = obtenerConexionPDO();
    }

    // Crea una nueva factura y la agrega a la base de datos
    public function createFactura(Factura $factura) {
        $query = "INSERT INTO factura (precio, fecha, dni_usuario, id_comanda) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$factura->getPreu(), $factura->getDataAsString(), $factura->getClient(), $factura->getComanda()]);

        return $stmt->rowCount() > 0;
    }

    public function readFactura($id) {
        $query = "SELECT * FROM factura WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        $facturaData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($facturaData) {
            $factura = new Factura();
            $factura->setPreu($facturaData['precio']);
            $factura->setData($facturaData['fecha']);
            $factura->setClient($facturaData['dni_usuario']);
            $factura->setComanda($facturaData['id_comanda']);
            return $factura;
        } else {
            return null;
        }
    }

    public function updateFactura($id, Factura $factura) {
        $query = "UPDATE factura SET precio = ?, fecha = ?, dni_usuario = ?, id_comanda = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$factura->getPreu(), $factura->getDataAsString(), $factura->getClient(), $factura->getComanda(), $id]);

        return $stmt->rowCount() > 0;
    }

    public function deleteFactura($id) {
        $query = "DELETE FROM factura WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }

    public function getAllFacturas() {
        $query = "SELECT * FROM factura";
        $stmt = $this->pdo->query($query);
        $facturas = [];

        while ($facturaData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $factura = new Factura();
            $factura->setNumFactura($facturaData['id']);
            $factura->setPreu($facturaData['precio']);
            $factura->setData($facturaData['fecha']);
            $factura->setClient($facturaData['dni_usuario']);
            $factura->setComanda($facturaData['id_comanda']);
            $facturas[] = $factura;
        }

        return $facturas;
    }

    public function getFacturaById($id) {
        $query = "SELECT * FROM factura WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        $facturaData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($facturaData) {
            $factura = new Factura();
            $factura->setNumFactura($facturaData['id']);
            $factura->setPreu($facturaData['precio']);
            $factura->setData($facturaData['fecha']);
            $factura->setClient($facturaData['dni_usuario']);
            $factura->setComanda($facturaData['id_comanda']);
            return $factura;
        } else {
            return null;
        }
    }

}


?>