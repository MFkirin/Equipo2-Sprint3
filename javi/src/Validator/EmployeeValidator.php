<?php
namespace App\Validator;
use App\Core\ValidatorInterface;
use App\Core\EntityInterface;

require_once __DIR__ . "/../Core/ValidatorInterface.php";
class EmployeeValidator implements ValidatorInterface
{

    private array $validRoles;

    public function validate(EntityInterface $entity): array
    {
        $errors = [];

        $username = $entity->getName();
        $lastname = $entity->getLastname();
        $type = $entity->getType();

        // Validar que el nom d'usuari no estigui buit i compleixi amb certs criteris
        if (empty($username) || strlen($username) < 3 || !ctype_alnum($username)) {
            $errors[] = 'El nom d\'usuari no pot estar buit.';
        }

        // Validar que el cognom d'usuari no estigui buit i compleixi amb certs criteris
        if (empty($lastname) || strlen($lastname) < 3 || !ctype_alnum($lastname)) {
            $errors[] = 'El cognom d\'usuari no pot estar buit.';
        }

        // Validar els rols específics
        //global $types;
        /*if (!in_array($type, $this->validRoles["type"])) {
            $errors[] = 'Tipus no vàlid.';
        }*/

        // Verificar si hi ha errors
        return $errors;

    }

    public function getValidRoles(): array
    {
        return $this->validRoles;
    }

    public function setValidRoles(array $validRoles): void
    {
        $this->validRoles = $validRoles;
    }
}
