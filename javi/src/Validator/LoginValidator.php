<?php
declare(strict_types=1);

namespace App\Validator;

use App\Core\EntityInterface;
use App\Core\ValidatorInterface;

/**
 * La classe LoginValidator implementa la interfície ValidatorInterface per a la validació de les dades de l'entitat 'Login'.
 * @author carest23
 */
class LoginValidator implements ValidatorInterface
{
    private $roles;

    /**
     * Constructor que rep els rols vàlids per a la validació.
     *
     * @param array $roles Els rols vàlids per a la validació.
     * @author carest23
     */
    public function __construct(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Valida les dades de l'entitat 'Login'.
     *
     * @param EntityInterface $entity L'entitat 'Login' a validar.
     * @return array Un array amb els missatges d'error trobats durant la validació.
     */
    public function validate(EntityInterface $entity): array
    {
        $errors = [];

        $username = $entity->getUsername();
        $password = $entity->getPassword();
        $role = $entity->getRole();

        if (empty($username) || strlen($username) < 3 || !ctype_alnum($username)) {
            $errors[] = 'El nom d\'usuari ha de tenir almenys 3 caràcters alfanumèrics.';
        }

        if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
            $errors[] = 'La contrasenya ha de tenir almenys 8 caràcters i incloure lletres i números.';
        }

        if (!in_array($role, $this->roles['roles'])) {
            $errors[] = 'Rol no vàlid.';
        }

        return $errors;
    }
}