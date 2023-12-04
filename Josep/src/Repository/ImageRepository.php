<?php

require_once __DIR__. '/../Core/Repository.php';

class ImageRepository extends Repository {

    public function find(int $id): EntityInterface {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM image WHERE ID = :id");
            $pdoStatement->execute([':id' => $id]);

            $imageRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if (!$imageRecord) {
                throw new RecordNotFoundException("No s'ha trobat cap registre amb l'ID $id.");
            }

            $imageObject = new $this->entityClassName;
            return $imageObject->fromArray($imageRecord);

        } catch (PDOException $e) {
            throw new RuntimeException('Error en la consulta: ' . $e->getMessage());
        }
    }

    public function findAll(): array {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM image");

        $pdoStatement->execute();

        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        $imageRecords = $pdoStatement->fetchAll();

        $images = [];
        foreach ($imageRecords as $imageRecord) {
            $images[] = call_user_func_array([$this->entityClassName, "fromArray"], [$imageRecord]);
        }

        return $images;
    }

    public function create(EntityInterface $entity): void {
        try {
            $data = Image::toArray($entity);

            unset($data["id"]);

            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $pdoStatement = $this->pdo->prepare("INSERT INTO image ($columns) VALUES ($values)");

            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId($id);

        } catch (PDOException $e) {
            throw new RuntimeException('Error al insertar imagen: ' . $e->getMessage());
        }
    }

    public function delete(EntityInterface $entity): void {
        try {
            $id = $entity->getId();

            $pdoStatement = $this->pdo->prepare("DELETE FROM image WHERE id = :id");

            $pdoStatement->execute([':id' => $id]);
        } catch (PDOException $e) {
            throw new RuntimeException('Error en eliminar la imagen: ' . $e->getMessage());
        }
    }

    public function update(EntityInterface $entity): void {

    }

    public function findByVehicleId(int $vehicleId): array {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM image WHERE vehicle_id = :vehicle_id");
            $pdoStatement->execute([':vehicle_id' => $vehicleId]);

            $imageRecords = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            $images = [];
            foreach ($imageRecords as $imageRecord) {
                $images[] = call_user_func_array([$this->entityClassName, "fromArray"], [$imageRecord]);
            }

            return $images;

        } catch (PDOException $e) {
            throw new RuntimeException('Error al buscar imágenes por ID de vehículo: ' . $e->getMessage());
        }
    }

}