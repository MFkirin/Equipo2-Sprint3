<?php
declare(strict_types=1);

namespace App\Repository;

/**
 * La classe OrderRepository gestiona les operacions de persistència per a l'entitat Order.
 * @author carest23
 */
class OrderRepository extends Repository
{

    /**
     * Recupera un registre de la taula 'order' basat en un ID proporcionat.
     *
     * @param int $id L'ID del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'order'.
     * @author carest23
     */
    public function find(int $id): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM `order` WHERE ID = :id");
            $pdoStatement->execute([':id' => $id]);

            $orderRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            if (!$orderRecord) {
                FlashMessage::set("message", "No s'ha trobat cap registre amb l'ID $id.");
                header('Location: order_list.php');
                exit;
            }

            $orderObject = new $this->entityClassName;
            return $orderObject->fromArray($orderRecord);

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: order_list.php');
            exit;
        }
    }

    /**
     * Recupera un registre actiu de la taula 'order' basat en un ID de client proporcionat.
     *
     * @param int $customerId L'ID del client per al qual buscar una comanda activa.
     * @return EntityInterface|null Un objecte que representa la comanda activa, o null si no s'ha trobat cap.
     * @throws PDOException Si hi ha un error durant l'execució de la consulta.
     * @author carest23
     */
    public function findActiveOrderByCustomer(int $customerId): ?EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM `order` WHERE customer_id = :customer_id AND state IN ('pending', 'processing')");
            $pdoStatement->execute([':customer_id' => $customerId]);

            $orderRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if (!$orderRecord) {
                return null;
            }

            $orderObject = new $this->entityClassName;
            return $orderObject->fromArray($orderRecord);
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els registres de la taula 'order' de la base de dades.
     *
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @author corriol
     */
    public function findAll(): array
    {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM `order`");
        $pdoStatement->execute();

        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        $orderRecords = $pdoStatement->fetchAll();

        $orders = [];
        foreach ($orderRecords as $orderRecord) {
            $orders[] = call_user_func_array([$this->entityClassName, "fromArray"], [$orderRecord]);
        }

        return $orders;
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
            $data = Order::toArray($entity);

            unset($data["id"]);

            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $pdoStatement = $this->pdo->prepare("INSERT INTO `order` ($columns) VALUES ($values)");

            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId((int)$id);

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: order_list.php');
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

            $pdoStatement = $this->pdo->prepare("DELETE FROM `order` WHERE id = :id");

            $pdoStatement->execute([':id' => $id]);

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: order_list.php');
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
            $data = Order::toArray($entity);

            $id = $entity->getId();

            $updateAssignments = [];
            foreach (array_keys($data) as $column) {
                $updateAssignments[] = "$column = :$column";
            }
            $updateSet = implode(', ', $updateAssignments);

            $pdoStatement = $this->pdo->prepare("UPDATE `order` SET $updateSet WHERE id = :id");

            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
            foreach ($data as $column => $value) {
                $pdoStatement->bindValue(":$column", $value);
            }
            $pdoStatement->execute();

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: order_list.php');
            exit;
        }
    }
}