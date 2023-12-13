<?php
declare(strict_types=1);

namespace App\Repository;

use App\Core\EntityInterface;
use App\Core\Repository;
use App\Entity\Brand;
use App\Helper\FlashMessage;
use PDO;
use PDOException;

/**
 * La classe BrandRepository gestiona les operacions de persistència per a l'entitat Brand.
 *
 * @author carest23
 */
class BrandRepository extends Repository
{

    /**
     * Recupera un registre de la taula 'brand' basat en un ID proporcionat.
     *
     * @param int $id L'ID del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'brand'.
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author carest23
     */
    public function find(int $id): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM brand WHERE id = :id");
            $pdoStatement->execute([':id' => $id]);

            $brandRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if (!$brandRecord) {
                FlashMessage::set("message", "No s'ha trobat cap registre amb l'ID $id.");
                header('Location: catalogue_list.php');
                exit;
            }

            $brandObject = new $this->entityClassName;
            return $brandObject->fromArray($brandRecord);
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els registres de la taula 'brand' de la base de dades.
     *
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author corriol
     */
    public function findAll(): array
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM marca");

            $pdoStatement->execute();

            $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

            $brandsRecords = $pdoStatement->fetchAll();

            $brands = [];
            foreach ($brandsRecords as $brandRecord) {
                $brands[] = call_user_func_array([$this->entityClassName, "fromArray"], [$brandRecord]);
            }

            return $brands;
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
            exit;
        }
    }

    /**
     * Crea un nou registre a la base de dades utilitzant les dades proporcionades per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté les dades per al nou registre.
     * @return void
     * @author carest23
     */
    public function create(EntityInterface $entity): void
    {
        try {
            $data = Brand::toArray($entity);

            unset($data["id"]);

            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $pdoStatement = $this->pdo->prepare("INSERT INTO brand ($columns) VALUES ($values)");
            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId((int)$id);

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
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


            $pdoStatement = $this->pdo->prepare("DELETE FROM brand WHERE id = :id");
            $pdoStatement->execute([':id' => $id]);

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
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
            $data = Brand::toArray($entity);

            $id = $entity->getId();

            $updateAssignments = [];
            foreach (array_keys($data) as $column) {
                $updateAssignments[] = "$column = :$column";
            }
            $updateSet = implode(', ', $updateAssignments);

            $pdoStatement = $this->pdo->prepare("UPDATE brand SET $updateSet WHERE id = :id");

            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
            foreach ($data as $column => $value) {
                $pdoStatement->bindValue(":$column", $value);
            }

            $pdoStatement->execute();

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
            exit;
        }
    }
}