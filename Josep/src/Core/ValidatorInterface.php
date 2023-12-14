<?php
namespace App\Core;

interface ValidatorInterface
{
    public function validate(EntityInterface $entity): array;
}