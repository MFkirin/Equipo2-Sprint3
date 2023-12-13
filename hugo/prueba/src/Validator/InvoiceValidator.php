<?php
declare(strict_types=1);

require_once __DIR__ . '/../Core/ValidatorInterface.php';

class InvoiceValidator implements ValidatorInterface
{
    public function validate(EntityInterface $entity): array
    {
        $errors = [];

        $number = $entity->getNumber();
        $price = $entity->getPrice();
        $date = $entity->getDate();

        // Validar el número de factura
        if (empty($number)) {
            $errors[] = 'El número de factura no puede estar vacío.';
        }

        // Validar que el número de factura tenga una longitud adecuada
        if (strlen($number) < 5 || strlen($number) > 20) {
            $errors[] = 'El número de factura debe tener entre 5 y 20 caracteres.';
        }

        // Validar que el número de factura solo contenga caracteres alfanuméricos y guiones
        if (!ctype_alnum(str_replace('-', '', $number))) {
            $errors[] = 'El número de factura solo puede contener caracteres alfanuméricos y guiones.';
        }

        // Validar el precio
        if (empty($price) || $price <= 0) {
            $errors[] = 'El precio de la factura debe ser mayor que cero.';
        }

        // Validar que el precio esté dentro de un rango específico
        $minPrice = 0.01; // Precio mínimo permitido
        $maxPrice = 1000000.00; // Precio máximo permitido

        if ($price < $minPrice || $price > $maxPrice) {
            $errors[] = 'El precio debe estar entre $0.01 y $1,000,000.00.';
        }

        // Validar que los IDs de cliente y pedido sean mayores que cero
        if ($entity->getCustomerId() <= 0) {
            $errors[] = 'El ID del cliente no es válido.';
        }

        if ($entity->getOrderId() <= 0) {
            $errors[] = 'El ID del pedido no es válido.';
        }

        // Validar que la fecha de la factura no sea en el futuro
        $currentDate = new DateTime();
        if ($date > $currentDate) {
            $errors[] = 'La fecha de la factura no puede estar en el futuro.';
        }

        return $errors;
    }
}