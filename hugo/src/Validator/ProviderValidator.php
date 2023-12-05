<?php

require __DIR__ . "/../Core/ValidatorInterface.php";

class ProviderValidator implements \ValidatorInterface
{
    /**
     * Valida les dades de l'entitat 'Provider'.
     *
     * @param EntityInterface $entity L'entitat 'Provider' a validar.
     * @return array Un array amb els missatges d'error trobats durant la validació.
     */
    public function validate(EntityInterface $entity): array
    {
        $errors = [];

        // Extract properties from the Provider entity
        $address = $entity->getAddress();
        $dni = $entity->getDNI();
        $phone = $entity->getPhone();
        $email = $entity->getEmail();
        $cif = $entity->getCIF();
        $managerNIF = $entity->getManagerNIF();
        $constitutionArticle = $entity->getConstitutionArticle();
        $lopdDoc = $entity->getLOPDdoc();
        $bankTitle = $entity->getBankTitle();

        // Validate Complete Address
        if (empty($address)) {
            $errors[] = 'El campo dirección no puede estar vacio.';
        }

        // Validate DNI
        if (!preg_match('/^[0-9]{8}[A-Z]{1}$/', $dni)) {
            $errors[] = 'Formato de DNI no válido.';
        }

        // Validate Phone
        if (empty($phone)) {
            $errors[] = "El campo de teléfonono puede estar vacio";
        } else if (!preg_match('/^[0-9]{9}$/', $phone)) {
            $errors[] = 'Formato de teléfono no válido.';
        }

        // Validate Email
        if (empty($email)){
            $errors[] = 'El campo correo no puede estar vacio.';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Formato de correo electrónico no válido.';

        }
        // Validate CIF
        if (empty($cif)) {
            $errors [] = "El campo CIF no puede estar vacio";
        } else if (!preg_match('/^[A-Z]{1}[0-9]{8}$/', $cif)) {
            $errors[] = 'Formato de CIF no válido.';
        }

        // Validate Manager NIF
        if (empty($managerNIF)) {
            $errors [] = " El campo NIF no puede estar vacio";
        } else if (!preg_match('/^[0-9]{8}[A-Z]{1}$/', $managerNIF)) {
            $errors[] = 'Formato de NIF del gerente no válido.';
        }

        // Validate Constitution Article
        if (empty($constitutionArticle)) {
            $errors[] = 'El artículo de constitución no puede estar vacío.';
        }

        // Validate LOPD Document
        if (empty($lopdDoc)) {
            $errors[] = 'El documento de LOPD no puede estar vacío.';
        }

        // Validate Bank Title
        if (empty($bankTitle)) {
            $errors[] = 'El certificado de titularidad de cuenta bancaria no puede estar vacío.';
        }


        return $errors;

    }
}