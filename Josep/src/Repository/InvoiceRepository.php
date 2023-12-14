<?php
declare(strict_types=1);

namespace App\Repository;

use App\Core\EntityInterface;
use App\Core\Repository;
use App\Entity\Invoice;
use App\Helper\FlashMessage;
use PDO;
use PDOException;

/**
 * La classe InvoiceRepository gestiona les operacions de persistència per a l'entitat Invoice.
 * @author carest23
 */
class InvoiceRepository extends Repository
{

    /**
     * Recupera un registre de la taula 'invoice' basat en un ID proporcionat.
     *
     * @param int $id L'ID del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'invoice'.
     * @author carest23
     */
    public function find(int $id): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM invoice WHERE ID = :id");
            $pdoStatement->execute([':id' => $id]);

            $invoiceRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            if (!$invoiceRecord) {
                FlashMessage::set("message", "No s'ha trobat cap registre amb l'ID $id.");
                header('Location: /invoice_list.php');
                exit;
            }

            $invoiceObject = new $this->entityClassName;
            return $invoiceObject->fromArray($invoiceRecord);

        } catch (PDOException $e) {
            FlashMessage::set("message", 'Error en la consulta: ' . $e->getMessage());
            header('Location: /invoice_list.php');
            exit;
        }
    }

    /**
     * Comprova si existeix una factura amb el número proporcionat.
     *
     * @param string $invoiceNumber El número de la factura a comprovar.
     * @return bool True si existeix una factura amb aquest número, False si no.
     * @author carest23
     */
    public function findByNumber(string $invoiceNumber): bool
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT COUNT(*) FROM invoice WHERE number = :number");
            $pdoStatement->execute([':number' => $invoiceNumber]);

            $count = $pdoStatement->fetchColumn();

            return $count > 0;

        } catch (PDOException $e) {
            FlashMessage::set("message", 'Error en la consulta: ' . $e->getMessage());
            header('Location: /invoice_list.php');
            exit;
        }
    }

    /**
     * Recupera la factura associada a un ID d'ordre proporcionat.
     *
     * @param int $orderId L'ID d'ordre per al qual buscar la factura associada.
     * @return EntityInterface|null Un objecte que representa la factura associada, o null si no s'ha trobat cap.
     * @author carest23
     */
    public function findByOrderId(int $orderId): ?EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM invoice WHERE order_id = :order_id");
            $pdoStatement->execute([':order_id' => $orderId]);

            $invoiceRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if (!$invoiceRecord) {
                return null;
            }

            $invoiceObject = new $this->entityClassName;
            return $invoiceObject->fromArray($invoiceRecord);
        } catch (PDOException $e) {
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: catalogue_list.php');
            exit;
        }
    }

    /**
     * Recupera tots els registres de la taula 'invoice' de la base de dades.
     *
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @author corriol
     */
    public function findAll(): array
    {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM invoice");
        $pdoStatement->execute();

        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        $invoiceRecords = $pdoStatement->fetchAll();

        $invoices = [];
        foreach ($invoiceRecords as $invoiceRecord) {
            $invoices[] = call_user_func_array([$this->entityClassName, "fromArray"], [$invoiceRecord]);
        }

        return $invoices;
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

            $pdoStatement = $this->pdo->prepare("INSERT INTO invoice ($columns) VALUES ($values)");

            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId((int)$id);

        } catch (PDOException $e) {
            FlashMessage::set("message", 'Error en crear un nou registre: ' . $e->getMessage());
            header('Location: /invoice_create.php');
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

            $pdoStatement = $this->pdo->prepare("DELETE FROM invoice WHERE id = :id");
            $pdoStatement->execute([':id' => $id]);

        } catch (PDOException $e) {
            FlashMessage::set("message", 'Error en eliminar el registre: ' . $e->getMessage());
            header('Location: /invoice_list.php');
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

            $pdoStatement = $this->pdo->prepare("UPDATE invoice SET $updateSet WHERE id = :id");

            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
            foreach ($data as $column => $value) {
                $pdoStatement->bindValue(":$column", $value);
            }

            $pdoStatement->execute();
        } catch (PDOException $e) {
            FlashMessage::set("message", 'Error en actualitzar el registre: ' . $e->getMessage());
            header('Location: /invoice_list.php');
            exit;
        }
    }
}