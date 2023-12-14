<?php
declare(strict_types=1);

namespace App\Validator;

/**
 * La classe InvoiceValidator implementa la interfície ValidatorInterface per a la validació de les entitats Invoice.
 * @author carest23
 */
class InvoiceValidator implements ValidatorInterface
{
    /**
     * Valida una entitat Invoice i retorna un array amb els errors trobats.
     *
     * @param EntityInterface $entity L'entitat Invoice a validar.
     * @return array Un array amb els errors de validació trobats.
     * @author carest23
     */
    public function validate(EntityInterface $entity): array
    {
        $errors = [];

        $number = $entity->getNumber();
        $price = $entity->getPrice();
        $date = $entity->getDate();

        if (empty($number)) {
            $errors[] = 'El número de factura no puede estar vacío.';
        }

        if (strlen($number) < 5 || strlen($number) > 20) {
            $errors[] = 'El número de factura debe tener entre 5 y 20 caracteres.';
        }

        if (!ctype_alnum(str_replace('-', '', $number))) {
            $errors[] = 'El número de factura solo puede contener caracteres alfanuméricos y guiones.';
        }

        if (empty($price) || $price <= 0) {
            $errors[] = 'El precio de la factura debe ser mayor que cero.';
        }

        $minPrice = 0.01;
        $maxPrice = 1000000.00;

        if ($price < $minPrice || $price > $maxPrice) {
            $errors[] = 'El precio debe estar entre $0.01 y $1,000,000.00.';
        }

        if ($entity->getCustomerId() <= 0) {
            $errors[] = 'El ID del cliente no es válido.';
        }

        if ($entity->getOrderId() <= 0) {
            $errors[] = 'El ID del pedido no es válido.';
        }

        $currentDate = new DateTime();
        if ($date > $currentDate) {
            $errors[] = 'La fecha de la factura no puede estar en el futuro.';
        }

        return $errors;
    }
}