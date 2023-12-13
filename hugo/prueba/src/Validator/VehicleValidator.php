<?php

require_once __DIR__. "/../Core/ValidatorInterface.php";

$roles = require_once __DIR__. "/../../config/config.php";


class VehicleValidator implements \ValidatorInterface
{
    /**
     * Validates data for the 'Vehicle' entity.
     *
     * @param EntityInterface $entity The 'Vehicle' entity to validate.
     * @return array An array of error messages found during validation.
     */
    public function validate(EntityInterface $entity): array
    {
        $errors = [];

        $plate = $entity->getPlate();
        $color = $entity->getColor();
        $isNew = $entity->isNew();
        $transportIncluded = $entity->isTransportIncluded();
        $chassisNumber = $entity->getChassisNumber();
        $km = $entity->getkilometers();
        $buyPrice = $entity->getBuyPrice();
        $sellPrice = $entity->getSellPrice();
        $iva = $entity->getIVA();


        if(empty($km)) {
            $errors[] = "El campo kilometros es obligatorio";
        } else if($km <= 1){
            $errors[] = "El numero de kilometros no puede ser menor de 1";
        }

        if(empty($buyPrice)){
            $errors[] = "El campo precio de compra es obligatorio";
        } else if($buyPrice <= 1){
            $errors[] = "El precio no puede ser menor de 1€";
        }

        if(empty($sellPrice)){
            $errors[] = "El campo precio de venta es obligatorio";
        } else if($sellPrice <= 1){
            $errors[] = "El precio no puede ser menor de 1€";
        }

        if (empty($color)) {
            $errors[] = "El campo Color es obligatorio .";
        }

        if(empty($plate)){
            $errors[]= "El campo matrícula no puede estar vacio";
        } else if (!preg_match('/^[0-9]{4}[A-Z]{3}$/', $plate)) {
            $errors[] = "La matrícula debe contener 4 números seguidos de 3 letras en mayúsculas.";
        }

        if( empty($iva)){
            $errors[] = "El campo de iva es obligatorio";
        } else if( $iva <=0 ){
            $errors[] = "El iva no puede ser un número no valido";
        }


        if (empty($isNew)) {
            $errors[] = "El campo Nuevo es obligatorio.";
        }

        if (empty($transportIncluded)) {
            $errors[] = "El campo transporte incluido es obligatorio.";
        }

        if (empty($chassisNumber) || strlen($chassisNumber) != 17 || !ctype_alnum($chassisNumber)) {
            $errors[] = "El campo número de bastidor debe contener 17 caracteres alfanuméricos.";
        }




        return $errors;

    }

}
