<?php

namespace App\Repository;

use App\Core\EntityInterface;
use App\Core\Repository;
use App\Entity\Image;
use App\Helper\FlashMessage;
use PDO;
use PDOException;
use RuntimeException;

class ImageRepository extends Repository
{

    /**
     * Recupera un registre de la taula 'image' basat en un ID proporcionat.
     *
     * @param int $id L'ID del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'image'.
     * @author Josep
     */
    public function find(int $id): EntityInterface {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM image WHERE id = :id");
            $pdoStatement->execute([':id' => $id]);

            $imageRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if (!$imageRecord) {
                FlashMessage::set("message", "No s'ha trobat cap registre amb l'ID $id.");
                header('Location: catalogue_list.php');
                exit;
            }

            $imageObject = new $this->entityClassName;
            return $imageObject->fromArray($imageRecord);
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els registres de la taula 'image' de la base de dades.
     *
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @author Josep
     */
    public function findAll(): array {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM image");

            $pdoStatement->execute();

            $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

            $imagesRecords = $pdoStatement->fetchAll();

            $images = [];
            foreach ($imagesRecords as $imageRecord) {
                $images[] = call_user_func_array([$this->entityClassName, "fromArray"], [$imageRecord]);
            }

            return $images;
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: vehicle_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els registres de la taula 'image' per a un Vehicle_ID proporcionat.
     *
     * @param int $vehicleId El Vehicle_ID dels registres a recuperar.
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @author
     */
    public function findAllByVehicleId(int $vehicleId): array {
        if ($vehicleId <= 0) {
            FlashMessage::set("message", 'Vehicle_ID no válido.');
            header('Location: catalogue_list.php');
            exit;
        }

        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM image WHERE vehicle_id = :vehicle_id");
            $pdoStatement->bindValue(':vehicle_id', $vehicleId, PDO::PARAM_INT);
            $pdoStatement->execute();

            $imagesRecords = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            $images = [];
            foreach ($imagesRecords as $imageRecord) {
                $images[] = call_user_func_array([$this->entityClassName, "fromArray"], [$imageRecord]);
            }

            return $images;
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
            exit;
        }
    }

    /**
     * Insereix un nou registre a la base de dades utilitzant les dades proporcionades per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté les dades per al nou registre.
     * @return void
     * @author Josep
     */
    public function create(EntityInterface $entity): void {
        try {
            $data = Image::toArray($entity);

            unset($data["id"]);

            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $pdoStatement = $this->pdo->prepare("INSERT INTO image ($columns) VALUES ($values)");

            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId((int)$id);

        } catch (PDOException $e) {
            throw new \Exception($e->getMessage());

        }
    }

    /**
     * Elimina un registre de la base de dades utilitzant la clau primària proporcionada per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté la clau primària per al registre a eliminar.
     * @return void
     * @author Josep
     */
    public function delete(EntityInterface $entity): void
    {
        try {
            $id = $entity->getId();

            $pdoStatement = $this->pdo->prepare("DELETE FROM image WHERE id = :id");

            $pdoStatement->execute([':id' => $id]);
        } catch (PDOException $e) {
            FlashMessage::set("message", 'Error en eliminar la imagen: ' . $e->getMessage());
            header('Location: vehicle_list.php');
            exit;
        }
    }

    /**
     * Actualitza un registre a la base de dades utilitzant les dades proporcionades per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté les dades per al registre a actualitzar.
     * @return void
     * @author Josep
     */
    public function update(EntityInterface $entity): void {
        try {
            $data = Image::toArray($entity);
            $id = $entity->getId();

            $updateAssignments = [];
            foreach (array_keys($data) as $column) {
                $updateAssignments[] = "$column = :$column";
            }
            $updateSet = implode(', ', $updateAssignments);

            $pdoStatement = $this->pdo->prepare("UPDATE image SET $updateSet WHERE id = :id");
            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

            foreach ($data as $column => $value) {
                $pdoStatement->bindValue(":$column", $value);
            }

            $pdoStatement->execute();
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: vehicle_list.php');
            exit;
        }
    }

    /**
     * @param EntityInterface $entity L'entitat que conté les dades per al registre a actualitzar.
     * @return array
     * @author Josep
     */
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