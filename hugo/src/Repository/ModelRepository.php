<?php

require_once __DIR__. '/../Core/Repository.php';

class ModelRepository extends Repository {

    public function find(int $id): EntityInterface {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM model WHERE ID = :id");
            $pdoStatement->execute([':id' => $id]);

            $modelRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if (!$modelRecord) {
                throw new RecordNotFoundException("No s'ha trobat cap registre amb l'ID $id.");
            }

            $vehicleObject = new $this->entityClassName;
            return $vehicleObject->fromArray($modelRecord);

        } catch (PDOException $e) {
            throw new RuntimeException('Error en la consulta: ' . $e->getMessage());
        }
    }

    public function findAll(): array {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM model");
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        $modelRecords = $pdoStatement->fetchAll();

        $models = [];
        foreach ($modelRecords as $modelRecord) {
            $models[] = call_user_func_array([$this->entityClassName, "fromArray"], [$modelRecord]);
        }

        return $models;
    }

    public function create(EntityInterface $entity): void {

    }

    public function delete(EntityInterface $entity): void {

    }

    public function update(EntityInterface $entity): void {

    }
}