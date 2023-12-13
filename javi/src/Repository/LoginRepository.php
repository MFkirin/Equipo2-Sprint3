<?php
declare(strict_types=1);

namespace App\Repository;

use App\Core\EntityInterface;
use App\Core\Repository;
use App\Entity\Login;
use App\Helper\FlashMessage;
use PDO;
use PDOException;

/**
 * La classe LoginRepository gestiona les operacions de persistència per a l'entitat Login.
 *
 * @author carest23
 */
class LoginRepository extends Repository
{

    /**
     * Recupera un registre de la taula 'login' basat en un ID proporcionat.
     *
     * @param int $id L'ID del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'login'.
     * @author carest23
     */
    public function find(int $id): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM login WHERE ID = :id");
            $pdoStatement->execute([':id' => $id]);

            // Comprovar si s'ha trobat un registre
            $loginRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            if (!$loginRecord) {
                FlashMessage::set("message", "No s'ha trobat cap registre amb l'ID $id.");
                header('Location: login.php');
                exit;
            }

            // Instanciar un objecte de la classe especificada
            $loginObject = new $this->entityClassName;
            return $loginObject->fromArray($loginRecord);


        } catch (PDOException $e) {
            // Gestionar l'excepció i llançar una RuntimeException
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: login.php');
            exit;
        }
    }

    /**
     * Recupera un registre de la taula 'login' basat en un username proporcionat.
     *
     * @param string $username L'username del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'login'.
     * @author carest23
     */
    public function findByUsername(string $username): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM login WHERE username = :username");
            $pdoStatement->execute([':username' => $username]);

            // Comprovar si s'ha trobat un registre
            $login = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            if (!$login) {
                FlashMessage::set("message", "No s'ha trobat cap registre amb l'usuari: $username.");
                header('Location: login.php');
                exit;
            }

            // Instanciar un objecte de la classe especificada
            $loginObject = new $this->entityClassName;
            return $loginObject->fromArray($login);


        } catch (PDOException $e) {
            // Gestionar l'excepció i llançar una RuntimeException
            FlashMessage::set("message", "Error en la consulta: " . $e->getMessage());
            header('Location: login.php');
            exit;
        }
    }


    /**
     * Recupera tots els registres de la taula 'login' de la base de dades.
     *
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @author carest23
     */
    public function findAll(): array
    {
        // Preparar la consulta SQL per seleccionar tots els registres de la taula 'login'.
        $pdoStatement = $this->pdo->prepare("SELECT * FROM login");

        // Executar la consulta SQL.
        $pdoStatement->execute();

        // Establir el mode de recuperació a associatiu.
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        // Obtenir tots els registres de la base de dades.
        $loginRecords = $pdoStatement->fetchAll();

        $logins = [];
        // Transformar els registres en objectes.
        foreach ($loginRecords as $loginRecord) {
            $logins[] = call_user_func_array([$this->entityClassName, "fromArray"], [$loginRecord]);
        }

        return $logins;
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
            // Obtenir les dades de l'objecte de l'entitat
            $data = Login::toArray($entity);

            unset($data["id"]);

            // Crear la consulta SQL utilitzant consultes preparades
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            // Preparar la consulta SQL
            $pdoStatement = $this->pdo->prepare("INSERT INTO login ($columns) VALUES ($values)");

            // Executar la consulta amb els valors de l'entitat
            $pdoStatement->execute($data);

            $id = $this->pdo->lastInsertId();
            $entity->setId((int)$id);

        } catch (PDOException $e) {
            // Gestionar l'excepció i llançar una RuntimeException
            FlashMessage::set("message", "Error al crear: " . $e->getMessage());
            header('Location: login.php');
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
            // Obtenir l'ID de l'objecte de l'entitat
            $id = $entity->getId();

            // Preparar la consulta SQL utilitzant consultes preparades
            $pdoStatement = $this->pdo->prepare("DELETE FROM login WHERE id = :id");

            // Executar la consulta amb el valor de l'ID
            $pdoStatement->execute([':id' => $id]);
        } catch (PDOException $e) {
            // Gestionar l'excepció i llançar una RuntimeException
            FlashMessage::set("message", "Error al eliminar: " . $e->getMessage());
            header('Location: login.php');
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
            // Obtenir les dades de l'objecte de l'entitat
            $data = Login::toArray($entity);

            // Obtenir l'ID de l'objecte de l'entitat
            $id = $entity->getId();

            // Crear la llista d'assignacions per a l'actualització
            $updateAssignments = [];
            foreach (array_keys($data) as $column) {
                $updateAssignments[] = "$column = :$column";
            }
            $updateSet = implode(', ', $updateAssignments);

            // Preparar la consulta SQL utilitzant consultes preparades
            $pdoStatement = $this->pdo->prepare("UPDATE login SET $updateSet WHERE id = :id");

            // Assignar el valor de l'ID i els valors de l'entitat
            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
            foreach ($data as $column => $value) {
                $pdoStatement->bindValue(":$column", $value);
            }

            // Executar la consulta
            $pdoStatement->execute();
        } catch (PDOException $e) {
            // Gestionar l'excepció i llançar una RuntimeException
            FlashMessage::set("message", "Error al actualitzar: " . $e->getMessage());
            header('Location: login.php');
            exit;
        }
    }
}