<?php

class ValidarVehicle
{
    public function validar($postData, $files)
    {
        $errors = [];

        // Validaciones
        if (empty($postData["nombre-vehiculo"])) {
            $errors[] = "El campo Nombre del vehículo es obligatorio.";
        }

        if (empty($postData["marca"])) {
            $errors[] = "El campo Marca es obligatorio.";
        }

        if (empty($postData["modelo"])) {
            $errors[] = "El campo Modelo es obligatorio.";
        }

        if (!preg_match('/^[0-9]{4}[A-Z]{3}$/', $postData["matricula"])) {
            $errors[] = "La matrícula debe contener 4 números seguidos de 3 letras en mayúsculas.";
        }

        if (empty($postData["tipMarcha"])) {
            $errors[] = "Debes seleccionar un tipo de marcha.";
        }

        if (!is_numeric($postData["kilometro"])) {
            $errors[] = "El campo Kilómetros debe contener solo números.";
        }

        if (!is_numeric($postData["precComp"])) {
            $errors[] = "El campo Precio de Compra debe contener solo números.";
        }

        if (!is_numeric($postData["precVenta"])) {
            $errors[] = "El campo Precio de Venta debe contener solo números.";
        }

        if (!is_numeric($postData["IVA"])) {
            $errors[] = "El campo IVA debe contener solo números.";
        }

        if (empty($postData["fPrimerMatric"]) || !$this->validateDate($postData["fPrimerMatric"])) {
            $errors[] = "El campo Fecha de Primera Matrícula es obligatorio y debe tener un formato válido (Y-m-d).";
        }

        if (!$this->isValidImageFile($files["imagen"])) {
            $errors[] = "El archivo de imagen no es válido. Asegúrate de cargar una imagen válida (JPG, JPEG, PNG, GIF).";
        }

        if (strlen($postData["numBast"]) < 17) {
            $errors[] = "El número de bastidor debe tener al menos 17 caracteres.";
        }

        return $errors;
    }

    private function validateDate($date)
    {
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
        return $dateObj && $dateObj->format('Y-m-d') === $date;
    }

    private function isValidImageFile($image)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        return in_array(strtolower($extension), $allowedExtensions);
    }
}
