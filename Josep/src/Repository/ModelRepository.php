<?php
namespace App\Repository;

use App\Core\EntityInterface;
use App\Core\Repository;
use App\Helper\FlashMessage;
use PDO;

/**
 * La classe ModelRepository gestiona les operacions de persistència per a l'entitat Model.
 * @author carest23
 */
class ModelRepository extends Repository
{
    /**
     * Recupera un registre de la taula 'model' basat en un ID proporcionat.
     *
     * @param int $id L'ID del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'model'.
     * @author carest23
     */
    public function find(int $id): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM model WHERE id = :id");
            $pdoStatement->execute([':id' => $id]);

            $modelRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if (!$modelRecord) {
                FlashMessage::set("message", "No s'ha trobat cap registre amb l'ID $id.");
                header('Location: catalogue_list.php');
                exit;
            }

            $modelObject = new $this->entityClassName;
            return $modelObject->fromArray($modelRecord);
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els registres de la taula 'model' de la base de dades.
     *
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @author corriol
     */
    public function findAll(): array
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM model");

            $pdoStatement->execute();

            $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

            $modelRecords = $pdoStatement->fetchAll();

            $models = [];
            foreach ($modelRecords as $modelRecord) {
                $models[] = call_user_func_array([$this->entityClassName, "fromArray"], [$modelRecord]);
            }

            return $models;
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
     * @author carest23
     */
    public function create(EntityInterface $entity): void
    {
        try {
            $data = Invoice::toArray($entity);

            unset($data["id"]);

            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $pdoStatement = $this->pdo->prepare("INSERT INTO model ($columns) VALUES ($values)");

            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId((int)$id);

        } catch (PDOException $e) {
            FlashMessage::set("message", 'Error en crear un nou registre: ' . $e->getMessage());
            header('Location: /catalogue_create.php');
            exit;
        }
    }

    /**
     * Elimina un registre de la base de dades utilitzant la clau primària proporcionada per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté la clau primària per al registre a eliminar.
     * @return void
     * @author carest23
     */
    public function delete(EntityInterface $entity): void
    {
        try {
            $id = $entity->getId();

            $pdoStatement = $this->pdo->prepare("DELETE FROM model WHERE id = :id");
            $pdoStatement->execute([':id' => $id]);

        } catch (PDOException $e) {
            FlashMessage::set("message", 'Error en eliminar el registre: ' . $e->getMessage());
            header('Location: /catalogue_list.php');
            exit;
        }
    }

    /**
     * Actualitza un registre a la base de dades utilitzant les dades proporcionades per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté les dades per al registre a actualitzar.
     * @return void
     * @author carest23
     */
    public function update(EntityInterface $entity): void
    {
        try {
            $data = Invoice::toArray($entity);

            $id = $entity->getId();

            $updateAssignments = [];
            foreach (array_keys($data) as $column) {
                $updateAssignments[] = "$column = :$column";
            }
            $updateSet = implode(', ', $updateAssignments);

            $pdoStatement = $this->pdo->prepare("UPDATE model SET $updateSet WHERE id = :id");

            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
            foreach ($data as $column => $value) {
                $pdoStatement->bindValue(":$column", $value);
            }

            $pdoStatement->execute();
        } catch (PDOException $e) {
            FlashMessage::set("message", 'Error en actualitzar el registre: ' . $e->getMessage());
            header('Location: /catalogue_list.php');
            exit;
        }
    }
}