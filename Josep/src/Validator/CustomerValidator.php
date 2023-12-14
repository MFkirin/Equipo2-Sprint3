<?php

namespace App\Validator;

// TODO: Una classe no hauria de dependre d'un fitxer de configuració cal usar una injecció de dependències
$roles = require __DIR__ . "/../../config/config.php";

class CustomerValidator implements \ValidatorInterface
{
    /**
     * Valida les dades de l'entitat 'Customer'.
     *
     * @param EntityInterface $entity L'entitat 'Login' a validar.
     * @return array Un array amb els missatges d'error trobats durant la validació.
     */
    public function validate(EntityInterface $entity): array
    {
        global $roles;
        $errors = [];

        $id = $entity->getId();
        $name = $entity->getName();
        $lastName = $entity->getLastname();
        $address = $entity->getAddress();
        $dni = $entity->getDni();
        $phone = $entity->getPhone();
        $businessName = $entity->getBusinessName();
        $email = $entity->getEmail();
        //$role = $entity->getRole();

        // Validar que el id no estigui buit i compleixi amb certs criteris
       /* if (empty($id) || strlen($id) > 3 || !preg_match('/^\d{1,3}$/', $id)) {
            $errors[] = 'El ID debe contener 3 números como máximo.';
        }*/

        // Validar que el nom del client no estigui buit i compleixi amb certs criteris
        if (empty($name) || strlen($name) < 3 || !preg_match('/^[a-zA-Z ]{0,25}$/', $name)) {
            $errors[] = 'El nombre del cliente debe ser válido.';
        }

        // Validar que el cognom del client no estigui buit i compleixi amb certs criteris
        if (empty($lastName) || strlen($lastName) < 3 || !preg_match('/^[a-zA-Z ]{0,25}$/', $lastName)) {
            $errors[] = 'El apellido del cliente debe ser válido.';
        }

        // Validar que la direecció del client no estigui buit i compleixi amb certs criteris
        /*if (empty($address) || strlen($address) < 3 || !preg_match('/^[a-zA-Z0-9\s,.\'-]+$/', $address)) {
            $errors[] = 'La dirección del cliente debe ser válido.';
        }*/

        // Validar que el dni del client no estigui buit i compleixi amb certs criteris
        if (empty($dni) || strlen($dni) > 9 || !preg_match('/^[0-9]{8}[A-Za-z]$/', $dni)) {
            $errors[] = 'El DNI del cliente debe ser válido.';
        }

        // Validar que el telèfon del client no estigui buit i compleixi amb certs criteris
        if (empty($phone) || strlen($phone) > 9 || !preg_match('/^[0-9]{9}$/', $phone)) {
            $errors[] = 'El teléfono del cliente debe ser válido.';
        }

        // Validar que la Raó Social del client no estigui buida i compleixi amb certs criteris
        /*if (empty($businessName) || strlen($businessName) < 3 || !preg_match('/^[a-zA-Z0-9.,&()\'"\/\s-]+$/u/', $businessName)) {
            $errors[] = 'La Razón Social debe ser válida.';
        }*/

        // Validar que el email del client no estigui buida i compleixi amb certs criteris
        if (empty($email) || strlen($email) < 3 || !preg_match('/^[a-z0-9]+@[a-z0-9]+\.[a-z]{2,4}$/', $email)) {
            $errors[] = 'El email debe ser válido.';
        }

        // Validar els rols específics
        /*if (!in_array($role, $roles['roles'])) {
            $errors[] = 'Rol no válido.';
        }*/

        // Verificar si hi ha errors
        return $errors;
    }
}

