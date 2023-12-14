<?php
declare(strict_types=1);

namespace App\Repository;

use App\Core\EntityInterface;
use App\Core\Repository;
use App\Entity\Vehicle;
use App\Helper\FlashMessage;
use PDO;
use PDOException;

class VehicleRepository extends Repository {
    /**
     * Recupera un registre de la taula 'vehicle' basat en un ID proporcionat.
     *
     * @param int $id L'ID del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'vehicle'.
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author Josep
     */
    public function find(int $id): EntityInterface {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM vehicle WHERE ID = :id");
            $pdoStatement->execute([':id' => $id]);

            $vehcileRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if (!$vehcileRecord) {
                FlashMessage::set("message", "No s'ha trobat cap registre amb l'ID $id.");
                header('Location: vehicle_list.php');
                exit;
            }

            $vehicleObject = new $this->entityClassName;
            return $vehicleObject->fromArray($vehcileRecord);

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: vehicle_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els vehicles associats a una comanda especificada pel seu ID.
     *
     * @param int $orderId L'ID de la comanda per a la qual recuperar els vehicles.
     * @return array Un array que conté els vehicles associats a la comanda.
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author carest23
     */
    public function findByOrderId(int $orderId): array {
        if ($orderId <= 0) {
            FlashMessage::set("message", "ID no vàlid.");
            header('Location: vehicle_list.php');
            exit;
        }

        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM vehicle WHERE order_id = :order_id");
            $pdoStatement->bindValue(':order_id', $orderId, PDO::PARAM_INT);
            $pdoStatement->execute();

            $vehicleRecords = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            $vehicles = [];
            foreach ($vehicleRecords as $vehicleRecord) {
                $vehicleObject = new $this->entityClassName;
                $vehicles[] = $vehicleObject->fromArray($vehicleRecord);
            }

            return $vehicles;

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: vehicle_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els vehicles ordenats per model.
     *
     * @return array Un array que conté els vehicles ordenats per model i que no formen part de cap Order.
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author carest23
     */
    public function findAllOrderedByModel(): array {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT vehicle.*, model.name AS model_name FROM vehicle JOIN model ON vehicle.model_id = model.id 
                                                        WHERE vehicle.order_id IS NULL  ORDER BY model.name;");

            $pdoStatement->execute();

            $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

            $vehicleRecords = $pdoStatement->fetchAll();

            $vehicles = [];
            foreach ($vehicleRecords as $vehicleRecord) {
                $vehicles[] = call_user_func_array([$this->entityClassName, "fromArray"], [$vehicleRecord]);
            }

            return $vehicles;
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: vehicle_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els vehicles ordenats per marca.
     *
     * @return array Un array que conté els vehicles ordenats per marca i que no formen part de cap Order.
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author Josep
     */
    public function findAllOrderedByBrand(): array {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT vehicle.*, model.name AS model_name, brand.name AS brand_name FROM vehicle 
                                                        JOIN model ON vehicle.model_id = model.id JOIN brand ON model.brand_id = brand.id 
                                                        WHERE vehicle.order_id IS NULL  ORDER BY brand.name;");

            $pdoStatement->execute();

            $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

            $vehicleRecords = $pdoStatement->fetchAll();

            $vehicles = [];
            foreach ($vehicleRecords as $vehicleRecord) {
                $vehicles[] = call_user_func_array([$this->entityClassName, "fromArray"], [$vehicleRecord]);
            }

            return $vehicles;
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: vehicle_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els registres de la taula 'vehicle' de la base de dades.
     *
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author Josep
     */
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

    /**
     * Insereix un nou registre a la base de dades utilitzant les dades proporcionades per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté les dades per al nou registre.
     * @return void
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author Josep
     */
    public function create(EntityInterface $entity): void {
        try {
            $data = Vehicle::toArray($entity);

            unset($data["id"]);

            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $pdoStatement = $this->pdo->prepare("INSERT INTO vehicle ($columns) VALUES ($values)");

            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId((int)$id);

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: vehicle_list.php');
            exit;
        }
    }

    /**
     * Elimina un registre de la base de dades utilitzant la clau primària proporcionada per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté la clau primària per al registre a eliminar.
     * @return void
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author Josep
     */
    public function delete(EntityInterface $entity): void {
        try {
            $id = $entity->getId();

            $pdoStatement = $this->pdo->prepare("DELETE FROM vehicle WHERE id = :id");
            $pdoStatement->execute([':id' => $id]);

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: vehicle_list.php');
            exit;
        }
    }

    /**
     * Actualitza un registre a la base de dades utilitzant les dades proporcionades per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté les dades per al registre a actualitzar.
     * @return void
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author Josep
     */
    public function update(EntityInterface $entity): void {
        try {
            $data = Vehicle::toArray($entity);
            $id = $entity->getId();

            $updateAssignments = [];
            foreach (array_keys($data) as $column) {
                $updateAssignments[] = "$column = :$column";
            }
            $updateSet = implode(', ', $updateAssignments);

            $pdoStatement = $this->pdo->prepare("UPDATE vehicle SET $updateSet WHERE id = :id");
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
     * Actualitza l'ID de la comanda associada a un vehicle específic.
     *
     * @param int $vehicleId L'ID del vehicle a actualitzar.
     * @param int|null $orderId L'ID de la comanda a assignar al vehicle (o null per desassociar).
     * @return void
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author carest23
     */
    public function updateOrderForVehicle(int $vehicleId, ?int $orderId = null) {
        try {
            $pdoStatement = $this->pdo->prepare("UPDATE vehicle SET order_id = :orderId WHERE id = :vehicleId");

            $pdoStatement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $pdoStatement->bindParam(':vehicleId', $vehicleId, PDO::PARAM_INT);

            $pdoStatement->execute();
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
            exit;
        }
    }
}