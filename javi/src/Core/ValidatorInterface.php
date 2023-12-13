<?php
declare(strict_types=1);

namespace App\Core;

interface ValidatorInterface
{
    public function validate(EntityInterface $entity): array;
}