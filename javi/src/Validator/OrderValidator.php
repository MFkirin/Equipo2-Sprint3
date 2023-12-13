<?php
declare(strict_types=1);

namespace App\Validator;

use App\Core\EntityInterface;
use App\Core\ValidatorInterface;

/**
 * La classe OrderValidator implementa la interfície ValidatorInterface per a la validació de les dades de l'entitat 'Order'.
 * @author carest23
 */
class OrderValidator implements ValidatorInterface
{
    private $states;

    /**
     * Constructor que rep els estats vàlids per a la validació.
     *
     * @param array $states Els estats vàlids per a la validació.
     * @author carest23
     */
    public function __construct(array $states)
    {
        $this->states = $states;
    }

    /**
     * Valida les dades de l'entitat 'Order'.
     *
     * @param EntityInterface $entity L'entitat 'Order' a validar.
     * @return array Un array amb els missatges d'error trobats durant la validació.
     * @author carest23
     */
    public function validate(EntityInterface $entity): array
    {
        $errors = [];

        $customerId = $entity->getCustomerId();
        $state = $entity->getState();

        if (empty($customerId) || $customerId < 0) {
            $errors[] = 'ID de client no vàlid.';
        }

        if (!in_array($state, $this->states['states'])) {
            $errors[] = 'Estat no vàlid.';
        }

        return $errors;
    }
}