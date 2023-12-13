<?php
declare(strict_types=1);

require_once __DIR__ . '/../Core/ValidatorInterface.php';

class OrderValidator implements \ValidatorInterface
{
    private $states;

    public function __construct(array $states)
    {
        $this->states = $states;
    }

    /**
     * Valida les dades de l'entitat 'Order'.
     *
     * @param EntityInterface $entity L'entitat 'Order' a validar.
     * @return array Un array amb els missatges d'error trobats durant la validació.
     */
    public function validate(EntityInterface $entity): array
    {
        $errors = [];

        $customerId = $entity->getCustomerId();
        $state = $entity->getState();

        // Validar que l'ID siga vàlid
        if (empty($customerId) || $customerId < 0 ) {
            $errors[] = 'ID de client no vàlid.';
        }

        // Validar els estats específics
        if (!in_array($state, $this->states['states'])) {
            $errors[] = 'Estat no vàlid.';
        }

        // Verificar si hi ha errors
        return $errors;
    }
}