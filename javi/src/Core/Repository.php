<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

/**
 *
 */
abstract class Repository
{

    protected PDO $pdo;
    protected string $entityClassName;

    public function __construct(PDO $pdo, string $entityClassName)
    {
        $this->pdo = $pdo;
        $this->entityClassName = $entityClassName;
    }

    /**
     * @param int $id
     * @return EntityInterface
     */
    abstract public function find(int $id): EntityInterface;

    /**
     * @return EntityInterface[]
     */
    abstract public function findAll(): array;

    /**
     * @param EntityInterface $entity
     * @return void
     */
    abstract public function create(EntityInterface $entity): void;

    /**
     * @param EntityInterface $entity
     * @return void
     */
    abstract public function delete(EntityInterface $entity): void;

    /**
     * @param EntityInterface $entity
     * @return void
     */
    abstract public function update(EntityInterface $entity): void;
}