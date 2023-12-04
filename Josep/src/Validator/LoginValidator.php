<?php

require_once __DIR__. "/../Core/ValidatorInterface.php";

// TODO: Una classe no hauria de dependre d'un fitxer de configuració cal usar una injecció de dependències
$roles = require_once __DIR__. "/../../config/config.php";

class LoginValidator implements \ValidatorInterface
{
    /**
     * Valida les dades de l'entitat 'Login'.
     *
     * @param EntityInterface $entity L'entitat 'Login' a validar.
     * @return array Un array amb els missatges d'error trobats durant la validació.
     */
    public function validate(EntityInterface $entity): array
    {
        global $roles;
        $errors = [];

        $username = $entity->getUsername();
        $password = $entity->getPassword();
        $role = $entity->getRole();

        // Validar que el nom d'usuari no estigui buit i compleixi amb certs criteris
        if (empty($username) || strlen($username) < 3 || !ctype_alnum($username)) {
            $errors[] = 'El nom d\'usuari ha de tenir almenys 3 caràcters alfanumèrics.';
        }

        // Validar que la contrasenya tinga almenys 8 caràcters, incloent lletres i números
        if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
            $errors[] = 'La contrasenya ha de tenir almenys 8 caràcters i incloure lletres i números.';
        }

        // Validar els rols específics
        if (!in_array($role, $roles['roles'])) {
            $errors[] = 'Rol no vàlid.';
        }

        // Verificar si hi ha errors
        return $errors;
    }
}