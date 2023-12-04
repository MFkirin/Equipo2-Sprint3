<?php

require_once __DIR__. '/../Core/Repository.php';

class VehicleRepository extends Repository {

    public function find(int $id): EntityInterface {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM vehicle WHERE ID = :id");
            $pdoStatement->execute([':id' => $id]);

            $vehcileRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if (!$vehcileRecord) {
                throw new RecordNotFoundException("No s'ha trobat cap registre amb l'ID $id.");
            }

            $vehicleObject = new $this->entityClassName;
            return $vehicleObject->fromArray($vehcileRecord);

        } catch (PDOException $e) {
            throw new RuntimeException('Error en la consulta: ' . $e->getMessage());
        }
    }

    public function findAll(): array {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM vehicle");

        $pdoStatement->execute();

        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        $vehicleRecords = $pdoStatement->fetchAll();

        $vehicles = [];
        foreach ($vehicleRecords as $vehicleRecord) {
            $vehicles[] = call_user_func_array([$this->entityClassName, "fromArray"], [$vehicleRecord]);
        }

        return $vehicles;
    }

    public function create(EntityInterface $entity): void {
        try {
            $data = Vehicle::toArray($entity);

            unset($data["id"]);

            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $pdoStatement = $this->pdo->prepare("INSERT INTO vehicle ($columns) VALUES ($values)");

            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId($id);

        } catch (PDOException $e) {
            throw new RuntimeException('Error en crear un nou vehicle: ' . $e->getMessage());
        }
    }

    public function delete(EntityInterface $entity): void {
        try {
            $id = $entity->getId();

            $pdoStatement = $this->pdo->prepare("DELETE FROM vehicle WHERE id = :id");

            $pdoStatement->execute([':id' => $id]);
        } catch (PDOException $e) {
            throw new RuntimeException('Error en eliminar el vehicle: ' . $e->getMessage());
        }
    }

    public function update(EntityInterface $entity): void {
        try {
            $data = Vehicle::toArray($entity);
            var_dump($data);

            $id = $entity->getId();

            $updateAssignments = [];
            foreach (array_keys($data) as $column) {
                $updateAssignments[] = "$column = :$column";
            }
            $updateSet = implode(', ', $updateAssignments);

            var_dump($updateSet);

            $pdoStatement = $this->pdo->prepare("UPDATE vehicle SET $updateSet WHERE id = :id");

            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
            foreach ($data as $column => $value) {
                $pdoStatement->bindValue(":$column", $value);
            }

            $pdoStatement->execute();
        } catch (PDOException $e) {
            throw new RuntimeException('Error en actualitzar el vehicle: ' . $e->getMessage());
        }
    }
}