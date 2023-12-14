<?php

namespace App\Validator;


use App\Core\EntityInterface;
use App\Core\ValidatorInterface;


class VehicleValidator implements ValidatorInterface
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
        //$observedDamages = $entity->getObsercvedDamages;
        $color = $entity->getColor();
        $registrationDate = $entity->getRegistrationDate();
        //$files = $entity->getFiles();
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

        /*if(empty($registrationDate)){
            $errors[] = "El campo Fecha de Primera Matrícula es obligatorio";
        } else if (!$this->validateDate($registrationDate)) {
            $errors[] = "El campo Fecha de Primera Matrícula debe tener un formato válido (Y-m-d).";
        }*/

        if (empty($isNew)) {
            $errors[] = "El campo Nuevo es obligatorio.";
        }

        if (empty($transportIncluded)) {
            $errors[] = "El campo transporte incluido es obligatorio.";
        }

        if (empty($chassisNumber) || !is_numeric($chassisNumber) || strlen($chassisNumber) != 17) {
            $errors[] = "El campo numero de bastidor debe contener 17 números.";
        }

        /* if(empty($files)){
             $errors[] = "El campo imagen es obligatorio";
         }else if (!$this->isValidImageFile($files["image"])) {
             $errors[] = "El archivo de imagen no es válido. Asegúrate de cargar una imagen válida (JPG, JPEG, PNG, GIF).";
         }*/


        return $errors;

    }

    /*private function validateDate($date)
    {
        $dateObj = \DateTime::createFromFormat('Y-m-d', $date);
        return $dateObj && $dateObj->format('Y-m-d') === $date;
    }*/

    /*private function isValidImageFile($image)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        return in_array(strtolower($extension), $allowedExtensions);
    }*/
}
