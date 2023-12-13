<?php
declare(strict_types=1);

require_once __DIR__ . '/../Core/Repository.php';
require_once __DIR__ . '/../Helper/FlashMessage.php';

/**
 * La classe LoginRepository gestiona les operacions de persistència per a l'entitat Login.
 */
class LoginRepository extends Repository
{

    /**
     * Recupera un registre de la taula 'login' basat en un ID proporcionat.
     *
     * @param int $id L'ID del registre a recuperar.
     * @return EntityInterface Un objecte que representa el registre de la taula 'login'.
     * @throws RecordNotFoundException Si no es troba cap registre amb l'ID proporcionat.
     * @throws RuntimeException Si hi ha algun error durant l'execució de la consulta.
     */
    public function find(int $id): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM login WHERE ID = :id");
            $pdoStatement->execute([':id' => $id]);

            // Comprovar si s'ha trobat un registre
            $loginRecord = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            if (!$loginRecord) {
                // Llançar una excepció si no s'ha trobat cap registre
                throw new RecordNotFoundException("No s'ha trobat cap registre amb l'ID $id.");
            }

            // Instanciar un objecte de la classe especificada
            $loginObject = new $this->entityClassName;
            return $loginObject->fromArray($loginRecord);


        } catch (PDOException $e) {
            // Gestionar l'excepció i llançar una RuntimeException
            throw new RuntimeException('Error en la consulta: ' . $e->getMessage());
        }
    }


    /**
     * Recupera tots els registres de la taula 'login' de la base de dades.
     *
     * @return array Un array que conté objectes de la classe especificada pel atribut 'entityClassName'.
     * Cada objecte és creat a partir de les dades dels registres de la base de dades.
     * @throws PDOException Si hi ha algun error en l'execució de la consulta SQL.
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
     * @throws RuntimeException Si hi ha algun error durant l'execució de la consulta.
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
            throw new RuntimeException('Error en crear un nou registre: ' . $e->getMessage());
        }
    }

    /**
     * Elimina un registre de la base de dades utilitzant la clau primària proporcionada per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté la clau primària per al registre a eliminar.
     * @return void
     * @throws RuntimeException Si hi ha algun error durant l'execució de la consulta.
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
            throw new RuntimeException('Error en eliminar el registre: ' . $e->getMessage());
        }
    }


    /**
     * Actualitza un registre a la base de dades utilitzant les dades proporcionades per l'entitat.
     *
     * @param EntityInterface $entity L'entitat que conté les dades per al registre a actualitzar.
     * @return void
     * @throws RuntimeException Si hi ha algun error durant l'execució de la consulta.
     */
    public function update(EntityInterface $entity): void
    {
        try {
            // Obtenir les dades de l'objecte de l'entitat
            $data = Login::toArray($entity);
            var_dump($data);

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
            throw new RuntimeException('Error en actualitzar el registre: ' . $e->getMessage());
        }
    }

    public function findByUsername(string $username): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM login WHERE username = :username");
            $pdoStatement->execute([':username' => $username]);

            // Comprovar si s'ha trobat un registre
            $login = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            if (!$login) {
                // Llançar una excepció si no s'ha trobat cap registre
                FlashMessage::set('Usuari no trobat',$username);
                throw new Exception("No s'ha trobat cap registre amb l'usuari: $username.");
            }

            // Instanciar un objecte de la classe especificada
            $loginObject = new $this->entityClassName;
            return $loginObject->fromArray($login);


        } catch (PDOException $e) {
            // Gestionar l'excepció i llançar una RuntimeException
            throw new RuntimeException('Error en la consulta: ' . $e->getMessage());
        }
    }
}