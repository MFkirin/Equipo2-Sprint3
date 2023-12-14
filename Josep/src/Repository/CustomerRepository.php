<?php
declare(strict_types=1);

namespace App\Repository;

/**
 * La classe CustomerRepository gestiona les operacions de persistència per a l'entitat Customer.
 */
class CustomerRepository extends Repository
{

    /**
     * Recupera un registre de la taula 'customer' basat en un ID proporcionat.
     *
     * @param int $id L'ID del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'customer'.
     * @author carest23
     */
    public function find(int $id): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM customer WHERE ID = :id");
            $pdoStatement->execute([':id' => $id]);

            $customerRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            if (!$customerRecord) {
                FlashMessage::set("message", "No s'ha trobat cap registre amb l'ID $id.");
                header('Location: customer_list.php');
                exit;
            }

            $customerObject = new $this->entityClassName;
            return $customerObject->fromArray($customerRecord);


        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: customer_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els registres de la taula 'customer' de la base de dades.
     *
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @author corriol
     */
    public function findAll(): array
    {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM customer");
        $pdoStatement->execute();

        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        $customerRecords = $pdoStatement->fetchAll();

        $customers = [];
        foreach ($customerRecords as $customerRecord) {
            $customers[] = call_user_func_array([$this->entityClassName, "fromArray"], [$customerRecord]);
        }

        return $customers;
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
            $data = Customer::toArray($entity);

            unset($data["id"]);

            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $pdoStatement = $this->pdo->prepare("INSERT INTO customer ($columns) VALUES ($values)");
            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId((int)$id);

        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: customer_list.php');
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

            $pdoStatement = $this->pdo->prepare("DELETE FROM customer WHERE id = :id");

            $pdoStatement->execute([':id' => $id]);
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: customer_list.php');
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
            $data = Customer::toArray($entity);

            $id = $entity->getId();

            $updateAssignments = [];
            foreach (array_keys($data) as $column) {
                $updateAssignments[] = "$column = :$column";
            }
            $updateSet = implode(', ', $updateAssignments);

            $pdoStatement = $this->pdo->prepare("UPDATE customer SET $updateSet WHERE id = :id");

            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
            foreach ($data as $column => $value) {
                $pdoStatement->bindValue(":$column", $value);
            }

            $pdoStatement->execute();
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: customer_list.php');
            exit;
        }
    }
}